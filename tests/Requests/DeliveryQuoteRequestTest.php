<?php

declare(strict_types=1);

namespace PicupTechnologies\PicupPHPApi\Tests\Requests;

use DateTime;
use PHPUnit\Framework\TestCase;
use PicupTechnologies\PicupPHPApi\Collections\ParcelCollection;
use PicupTechnologies\PicupPHPApi\Enums\ParcelSizeEnum;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryParcel;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryParcelCollection;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryReceiver;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryReceiverAddress;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryReceiverContact;
use PicupTechnologies\PicupPHPApi\Objects\DeliverySender;
use PicupTechnologies\PicupPHPApi\Objects\DeliverySenderAddress;
use PicupTechnologies\PicupPHPApi\Objects\DeliverySenderContact;
use PicupTechnologies\PicupPHPApi\Objects\Parcel;
use PicupTechnologies\PicupPHPApi\Objects\ParcelDimensions;
use PicupTechnologies\PicupPHPApi\Requests\DeliveryQuoteRequest;

/**
 * Class DeliveryQuoteRequestTest
 *
 * Simply tests that the fields are set correctly to snake_case
 */
class DeliveryQuoteRequestTest extends TestCase
{
    public function testMake() : void
    {
        $deliveryQuoteRequest = new DeliveryQuoteRequest();

        $test = 'merchant-555-444-333';
        $deliveryQuoteRequest->setMerchantId($test);
        $this->assertSame($test, $deliveryQuoteRequest->getMerchantId());

        $test = 'customer-123';
        $deliveryQuoteRequest->setCustomerRef($test);
        $this->assertSame($test, $deliveryQuoteRequest->getCustomerRef());

        $test = new DateTime();
        $deliveryQuoteRequest->setScheduledDate($test);
        $this->assertSame($test, $deliveryQuoteRequest->getScheduledDate());

        $test = true;
        $deliveryQuoteRequest->setIsForContractDriver($test);
        $this->assertSame($test, $deliveryQuoteRequest->isForContractDriver());

        $test = 'user-1111-2222';
        $deliveryQuoteRequest->setUserId($test);
        $this->assertSame($test, $deliveryQuoteRequest->getUserId());

        $deliveryQuoteRequest->enableThirdPartyCouriers();
        $this->assertSame('ALL', $deliveryQuoteRequest->getCourierCosting());

        $deliveryQuoteRequest->disableThirdPartyCouriers();
        $this->assertSame('NONE', $deliveryQuoteRequest->getCourierCosting());

        $deliveryQuoteRequest->setOptimizeWaypoints(true);
        $this->assertTrue($deliveryQuoteRequest->isOptimizeWaypoints());
        $deliveryQuoteRequest->setOptimizeWaypoints(false);
        $this->assertFalse($deliveryQuoteRequest->isOptimizeWaypoints());

        $senderAddress = new DeliverySenderAddress();
        $senderAddress->setWarehouseId('warehouse-123');
        $senderContact = new DeliverySenderContact();
        $specialInstructions = 'Test 555';

        $sender = new DeliverySender(
            $senderAddress,
            $senderContact,
            $specialInstructions
        );

        $deliveryQuoteRequest->setSender($sender);
        $this->assertSame($sender, $deliveryQuoteRequest->getSender());

        // add receiver
        $deliveryReceiverAddress = new DeliveryReceiverAddress();
        $deliveryReceiverAddress->setStreetOrFarmNo('123');

        $deliveryReceiverContact = new DeliveryReceiverContact();
        $deliveryReceiverContact->setName('Test Name');
        $deliveryReceiverContact->setEmail('test@email.com');

        $parcels = new ParcelCollection();
        $parcels->addParcel(new Parcel(ParcelSizeEnum::PARCEL_MEDIUM, 'Medium Parcel', new ParcelDimensions(1, 2, 3), 0.0));

        $deliveryReceiver = new DeliveryReceiver(
            $deliveryReceiverAddress,
            $deliveryReceiverContact,
            $parcels
        );

        $deliveryQuoteRequest->addReceiver($deliveryReceiver);
        $this->assertSame($deliveryReceiver, $deliveryQuoteRequest->getReceivers()[0]);

        $deliveryQuoteRequest->setReceivers([$deliveryReceiver]);
        $this->assertSame($deliveryReceiver, $deliveryQuoteRequest->getReceivers()[0]);

        $serialized = json_encode($deliveryQuoteRequest);

        $unserialized = json_decode($serialized, false);
        $this->assertSame('customer-123', $unserialized->customer_ref);
        $this->assertSame('merchant-555-444-333', $unserialized->merchant_id);

        $this->assertTrue($unserialized->is_for_contract_driver);

        $sender = $unserialized->sender;
        $this->assertSame('warehouse-123', $sender->address->warehouse_id);
        $this->assertSame('Test 555', $sender->special_instructions);
    }
}
