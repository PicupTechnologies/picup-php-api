<?php

declare(strict_types=1);

namespace PicupTechnologies\PicupPHPApi\Tests\Requests;

use DateTime;
use Faker\Factory;
use PHPUnit\Framework\TestCase;
use PicupTechnologies\PicupPHPApi\Collections\ParcelCollection;
use PicupTechnologies\PicupPHPApi\Enums\ParcelSizeEnum;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryReceiver;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryReceiverAddress;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryReceiverContact;
use PicupTechnologies\PicupPHPApi\Objects\DeliverySender;
use PicupTechnologies\PicupPHPApi\Objects\DeliverySenderAddress;
use PicupTechnologies\PicupPHPApi\Objects\DeliverySenderContact;
use PicupTechnologies\PicupPHPApi\Objects\Parcel;
use PicupTechnologies\PicupPHPApi\Objects\ParcelDimensions;
use PicupTechnologies\PicupPHPApi\Requests\DeliveryOrderRequest;

class DeliveryOrderRequestTest extends TestCase
{
    /**
     * Simply tests the getters+setters and basic details
     */
    public function testBasics() : void
    {
        $faker = Factory::create();

        $deliveryOrderRequest = new DeliveryOrderRequest();

        // basics

        $test = 'customer-123';
        $deliveryOrderRequest->setCustomerRef($test);
        $this->assertSame($test, $deliveryOrderRequest->getCustomerRef());

        $test = 'merchant-abcd-efgh-1234';
        $deliveryOrderRequest->setMerchantId($test);
        $this->assertSame($test, $deliveryOrderRequest->getMerchantId());

        $test = true;
        $deliveryOrderRequest->setIsRoundTrip($test);
        $this->assertSame($test, $deliveryOrderRequest->isRoundTrip());

        $test = true;
        $deliveryOrderRequest->setIsForContractDriver($test);
        $this->assertSame($test, $deliveryOrderRequest->isForContractDriver());

        $test = new DateTime();
        $deliveryOrderRequest->setScheduledDate($test);
        $this->assertSame($test, $deliveryOrderRequest->getScheduledDate());

        $test = 'vehicle-space-ship';
        $deliveryOrderRequest->setVehicleId($test);
        $this->assertSame($test, $deliveryOrderRequest->getVehicleId());

        // sender

        $senderAddress = new DeliverySenderAddress();
        $lat = $faker->latitude;
        $senderAddress->setLatitude($lat);
        $this->assertSame($lat, $senderAddress->getLatitude());

        $lng = $faker->longitude;
        $senderAddress->setLongitude($lng);
        $this->assertSame($lng, $senderAddress->getLongitude());

        $senderContact = new DeliverySenderContact();
        $senderContact->setName('Sender Name');
        $this->assertSame('Sender Name', $senderContact->getName());

        $senderContact->setEmail('test@email.com');
        $this->assertSame('test@email.com', $senderContact->getEmail());

        $sender = new DeliverySender($senderAddress, $senderContact, 'Knock on back door');

        $deliveryOrderRequest->setSender($sender);

        $this->assertSame($sender, $deliveryOrderRequest->getSender());

        // receivers
        $receiverAddress = new DeliveryReceiverAddress();
        $lat = $faker->latitude;
        $receiverAddress->setLatitude($lat);
        $this->assertSame($lat, $receiverAddress->getLatitude());

        $lng = $faker->longitude;
        $receiverAddress->setLongitude($lng);
        $this->assertSame($lng, $receiverAddress->getLongitude());

        $receiverContact = new DeliveryReceiverContact();
        $receiverContact->setName('Sender Name');
        $this->assertSame('Sender Name', $receiverContact->getName());

        $receiverContact->setEmail('test@email.com');
        $this->assertSame('test@email.com', $receiverContact->getEmail());

        $parcels = new ParcelCollection();
        $parcels->addParcel(new Parcel(ParcelSizeEnum::PARCEL_MEDIUM, 'Medium Parcel', new ParcelDimensions(1, 2, 3), 0.0));

        $receiver = new DeliveryReceiver($receiverAddress, $receiverContact, $parcels, 'Go home');

        $this->assertSame($parcels, $receiver->getParcels());
        $deliveryOrderRequest->setReceivers([$receiver]);

        $this->assertSame($receiver, $deliveryOrderRequest->getReceivers()[0]);
    }

    /**
     * Ensure that the camelCased variables are correctly serialized to snake_case for
     * picup api
     */
    public function testMakesValidJson() : void
    {
        $deliveryOrderRequest = new DeliveryOrderRequest();
        $deliveryOrderRequest->setCustomerRef('customer-12345');
        $deliveryOrderRequest->setMerchantId('merchant-555-444-333');
        $deliveryOrderRequest->setIsRoundTrip(true);
        $deliveryOrderRequest->setIsForContractDriver(true);
        $deliveryOrderRequest->setScheduledDate(new DateTime());

        $parcels = new ParcelCollection();
        $parcels->addParcel(new Parcel(ParcelSizeEnum::PARCEL_MEDIUM, 'Medium Parcel', new ParcelDimensions(1, 2, 3), 0.0));

        $serialized = json_encode($deliveryOrderRequest);

        $unserialized = json_decode($serialized, false);
        $this->assertSame('customer-12345', $unserialized->customer_ref);
        $this->assertSame('merchant-555-444-333', $unserialized->merchant_id);

        $this->assertTrue($unserialized->is_round_trip);
        $this->assertTrue($unserialized->is_for_contract_driver);
    }
}
