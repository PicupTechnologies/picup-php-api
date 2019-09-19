<?php

namespace PicupTechnologies\PicupPHPApi\Tests\Objects;

use DateTime;
use PHPUnit\Framework\TestCase;
use PicupTechnologies\PicupPHPApi\Enums\ParcelSizeEnum;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryOrderRequest;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryParcel;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryParcelCollection;

class DeliveryOrderRequestTest extends TestCase
{
    /**
     * Ensure that the camelCased variables are correctly serialized to snake_case for
     * picup api
     */
    public function testMakesValidJson(): void
    {
        $deliveryOrderRequest = new DeliveryOrderRequest();
        $deliveryOrderRequest->customerRef = 'customer-12345';
        $deliveryOrderRequest->merchantId = 'merchant-555-444-333';
        $deliveryOrderRequest->isRoundTrip = true;
        $deliveryOrderRequest->isForContractDriver = true;
        $deliveryOrderRequest->isPreAssignTrackingNumber = true;
        $deliveryOrderRequest->scheduledDate = new DateTime();

        $parcels = new DeliveryParcelCollection();
        $parcels->addParcel(new DeliveryParcel('123', ParcelSizeEnum::PARCEL_MEDIUM));

        $deliveryOrderRequest->parcels = $parcels;

        $serialized = json_encode($deliveryOrderRequest);

        $unserialized = json_decode($serialized, false);
        $this->assertEquals('customer-12345', $unserialized->customer_ref);
        $this->assertEquals('merchant-555-444-333', $unserialized->merchant_id);

        $this->assertEquals(true, $unserialized->is_round_trip);
        $this->assertEquals(true, $unserialized->is_for_contract_driver);
        $this->assertEquals(true, $unserialized->is_pre_assign_tracking_number);
    }
}
