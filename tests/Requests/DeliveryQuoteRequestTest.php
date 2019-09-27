<?php

namespace PicupTechnologies\PicupPHPApi\Tests\Requests;

use DateTime;
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
use PicupTechnologies\PicupPHPApi\Requests\DeliveryQuoteRequest;

/**
 * Class DeliveryQuoteRequestTest
 *
 * Simply tests that the fields are set correctly to snake_case
 *
 * @package PicupTechnologies\PicupPHPApi\Tests\Objects
 */
class DeliveryQuoteRequestTest extends TestCase
{
    public function testMake(): void
    {
        $deliveryQuoteRequest = new DeliveryQuoteRequest();

        $deliveryQuoteRequest->scheduledDate = new DateTime();
        $deliveryQuoteRequest->isForContractDriver = true;

        $deliveryQuoteRequest->customerRef = 'customer-123';
        $deliveryQuoteRequest->merchantId = 'merchant-555-444-333';

        $senderAddress = new DeliverySenderAddress();
        $senderAddress->setWarehouseId('warehouse-123');
        $senderContact = new DeliverySenderContact();
        $specialInstructions = 'Test 555';

        $sender = new DeliverySender(
            $senderAddress,
            $senderContact,
            $specialInstructions
        );

        $deliveryQuoteRequest->sender = $sender;

        // add receiver
        $deliveryReceiverAddress = new DeliveryReceiverAddress();
        $deliveryReceiverAddress->setStreetOrFarmNo(123);

        $deliveryReceiverContact = new DeliveryReceiverContact();
        $deliveryReceiverContact->name = 'Test Name';
        $deliveryReceiverContact->email = 'test@email.com';

        $parcels = new DeliveryParcelCollection();
        $parcels->addParcel(new DeliveryParcel('123', ParcelSizeEnum::PARCEL_MEDIUM));

        $deliveryReceiver = new DeliveryReceiver(
            $deliveryReceiverAddress,
            $deliveryReceiverContact,
            $parcels
        );

        $deliveryQuoteRequest->receiver = $deliveryReceiver;

        $serialized = json_encode($deliveryQuoteRequest);

        $unserialized = json_decode($serialized, false);
        $this->assertEquals('customer-123', $unserialized->customer_ref);
        $this->assertEquals('merchant-555-444-333', $unserialized->merchant_id);

        $this->assertEquals(true, $unserialized->is_for_contract_driver);

        $sender = $unserialized->sender;
        $this->assertEquals('warehouse-123', $sender->address->warehouse_id);
        $this->assertEquals('Test 555', $sender->special_instructions);
    }
}
