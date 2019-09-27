<?php

namespace PicupTechnologies\PicupPHPApi\Tests\Requests;

use DateTime;
use Faker\Factory;
use PHPUnit\Framework\TestCase;
use PicupTechnologies\PicupPHPApi\Enums\ParcelSizeEnum;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryParcel;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryParcelCollection;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryReceiver;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryReceiverAddress;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryReceiverContact;
use PicupTechnologies\PicupPHPApi\Objects\DeliverySender;
use PicupTechnologies\PicupPHPApi\Objects\DeliverySenderAddress;
use PicupTechnologies\PicupPHPApi\Objects\DeliverySenderContact;
use PicupTechnologies\PicupPHPApi\Requests\DeliveryOrderRequest;

class DeliveryOrderRequestTest extends TestCase
{
    /**
     * Simply tests the getters+setters and basic details
     */
    public function testBasics(): void
    {
        $faker = Factory::create();

        $deliveryOrderRequest = new DeliveryOrderRequest();

        // basics

        $test = 'customer-123';
        $deliveryOrderRequest->setCustomerRef($test);
        $this->assertEquals($test, $deliveryOrderRequest->getCustomerRef());

        $test = 'merchant-abcd-efgh-1234';
        $deliveryOrderRequest->setMerchantId($test);
        $this->assertEquals($test, $deliveryOrderRequest->getMerchantId());

        $test = true;
        $deliveryOrderRequest->setIsRoundTrip($test);
        $this->assertEquals($test, $deliveryOrderRequest->isRoundTrip());

        $test = true;
        $deliveryOrderRequest->setIsForContractDriver($test);
        $this->assertEquals($test, $deliveryOrderRequest->isForContractDriver());

        $test = new DateTime();
        $deliveryOrderRequest->setScheduledDate($test);
        $this->assertEquals($test, $deliveryOrderRequest->getScheduledDate());

        $test = 'vehicle-space-ship';
        $deliveryOrderRequest->setVehicleId($test);
        $this->assertEquals($test, $deliveryOrderRequest->getVehicleId());

        // sender

        $senderAddress = new DeliverySenderAddress();
        $lat = $faker->latitude;
        $senderAddress->setLatitude($lat);
        $this->assertEquals($lat, $senderAddress->getLatitude());

        $lng = $faker->longitude;
        $senderAddress->setLongitude($lng);
        $this->assertEquals($lng, $senderAddress->getLongitude());

        $senderContact = new DeliverySenderContact();
        $senderContact->setName('Sender Name');
        $this->assertEquals('Sender Name', $senderContact->getName());

        $senderContact->setEmail('test@email.com');
        $this->assertEquals('test@email.com', $senderContact->getEmail());

        $sender = new DeliverySender($senderAddress, $senderContact, 'Knock on back door');

        $deliveryOrderRequest->setSender($sender);

        $this->assertEquals($sender, $deliveryOrderRequest->getSender());

        // receivers
        $receiverAddress = new DeliveryReceiverAddress();
        $lat = $faker->latitude;
        $receiverAddress->setLatitude($lat);
        $this->assertEquals($lat, $receiverAddress->getLatitude());

        $lng = $faker->longitude;
        $receiverAddress->setLongitude($lng);
        $this->assertEquals($lng, $receiverAddress->getLongitude());

        $receiverContact = new DeliveryReceiverContact();
        $receiverContact->setName('Sender Name');
        $this->assertEquals('Sender Name', $receiverContact->getName());

        $receiverContact->setEmail('test@email.com');
        $this->assertEquals('test@email.com', $receiverContact->getEmail());

        $parcels = new DeliveryParcelCollection();
        $parcels->addParcel(new DeliveryParcel('parcel-123', 'parcel-medium'));

        $receiver = new DeliveryReceiver($receiverAddress, $receiverContact, $parcels, 'Go home');

        $this->assertEquals($parcels, $receiver->getParcels());
        $deliveryOrderRequest->setReceivers([$receiver]);

        $this->assertEquals($receiver, $deliveryOrderRequest->getReceivers()[0]);
    }

    /**
     * Ensure that the camelCased variables are correctly serialized to snake_case for
     * picup api
     */
    public function testMakesValidJson(): void
    {
        $deliveryOrderRequest = new DeliveryOrderRequest();
        $deliveryOrderRequest->setCustomerRef('customer-12345');
        $deliveryOrderRequest->setMerchantId('merchant-555-444-333');
        $deliveryOrderRequest->setIsRoundTrip(true);
        $deliveryOrderRequest->setIsForContractDriver(true);
        $deliveryOrderRequest->setScheduledDate(new DateTime());

        $parcels = new DeliveryParcelCollection();
        $parcels->addParcel(new DeliveryParcel('123', ParcelSizeEnum::PARCEL_MEDIUM));

        $serialized = json_encode($deliveryOrderRequest);

        $unserialized = json_decode($serialized, false);
        $this->assertEquals('customer-12345', $unserialized->customer_ref);
        $this->assertEquals('merchant-555-444-333', $unserialized->merchant_id);

        $this->assertEquals(true, $unserialized->is_round_trip);
        $this->assertEquals(true, $unserialized->is_for_contract_driver);
    }
}
