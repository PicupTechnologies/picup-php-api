<?php

declare(strict_types=1);

namespace PicupTechnologies\PicupPHPApi\Tests\Objects\DeliveryBucket;

use DateTime;
use PHPUnit\Framework\TestCase;
use PicupTechnologies\PicupPHPApi\Collections\ParcelCollection;
use PicupTechnologies\PicupPHPApi\Enums\ParcelSizeEnum;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryBucket\DeliveryBucketDetails;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryBucket\DeliveryShipment;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryBucket\DeliveryShipmentAddress;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryBucket\DeliveryShipmentContact;
use PicupTechnologies\PicupPHPApi\Objects\Parcel;
use PicupTechnologies\PicupPHPApi\Objects\ParcelDimensions;
use PicupTechnologies\PicupPHPApi\Requests\DeliveryBucketRequest;

class DeliveryBucketRequestTest extends TestCase
{
    public function testShipments() : void
    {
        // Set up
        $consignmentId = 'consignment-555';
        $businessRef = 'business-ref-444';

        // Create
        $deliveryBucket = new DeliveryBucketRequest();

        $shipment = new DeliveryShipment();
        $shipment->setConsignment($consignmentId);
        $shipment->setBusinessReference($businessRef);

        $deliveryShipmentAddress = new DeliveryShipmentAddress();
        $shipment->setAddress($deliveryShipmentAddress);

        $deliveryShipmentContact = new DeliveryShipmentContact();
        $shipment->setContact($deliveryShipmentContact);

        $deliveryShipmentParcelCollection = new ParcelCollection();
        $deliveryShipmentParcel = new Parcel(ParcelSizeEnum::PARCEL_MEDIUM, 'Medium Parcel', new ParcelDimensions(1, 2, 3), 0.0);
        $deliveryShipmentParcelCollection->addParcel($deliveryShipmentParcel);
        $shipment->setParcelCollection($deliveryShipmentParcelCollection);
        $shipment->addParcel($deliveryShipmentParcel);

        $deliveryBucket->setShipments([$shipment]);

        $shipmentsReturned = $deliveryBucket->getShipments();
        $shipmentReturned = $shipmentsReturned[0];

        $parcels = $shipmentReturned->getParcelCollection()->getParcels();

        $this->assertSame($consignmentId, $shipmentReturned->getConsignment());
        $this->assertSame($businessRef, $shipmentReturned->getBusinessReference());
        $this->assertSame($deliveryShipmentAddress, $shipmentReturned->getAddress());
        $this->assertSame($deliveryShipmentContact, $shipmentReturned->getContact());
        $this->assertSame($deliveryShipmentParcel, $parcels[0]);
        $this->assertSame($deliveryShipmentParcel, $parcels[1]);

        // Test
        $decoded = json_decode(json_encode($deliveryBucket), false);

        $shipmentsDecoded = $decoded->shipments;
        $shipmentDecoded = $shipmentsDecoded[0];

        $this->assertSame($consignmentId, $shipmentDecoded->consignment);
        $this->assertSame($businessRef, $shipmentDecoded->business_reference);
    }

    public function testBucketDetails() : void
    {
        $deliveryBucket = new DeliveryBucketRequest();

        $bucketDetails = new DeliveryBucketDetails();

        $warehouseId = 'warehouse-123';
        $bucketDetails->setWarehouseId($warehouseId);
        $this->assertSame($warehouseId, $bucketDetails->getWarehouseId());

        $warehouseName = 'Warehouse Tester';
        $bucketDetails->setWarehouseName($warehouseName);
        $this->assertSame($warehouseName, $bucketDetails->getWarehouseName());

        $deliveryDate = new DateTime('01/01/2000 09:30:00');
        $bucketDetails->setDeliveryDate($deliveryDate);
        $this->assertSame($deliveryDate, $bucketDetails->getDeliveryDate());

        $shiftStart = new DateTime('01/01/2000 09:30:00');
        $bucketDetails->setShiftStart($shiftStart);
        $this->assertSame($shiftStart, $bucketDetails->getShiftStart());

        $shiftEnd = new DateTime('01/01/2000 16:30:00');
        $bucketDetails->setShiftEnd($shiftEnd);
        $this->assertSame($shiftEnd, $bucketDetails->getShiftEnd());

        $deliveryBucket->setBucketDetails($bucketDetails);

        $testBucketDetails = $deliveryBucket->getBucketDetails();
        $this->assertSame($bucketDetails, $testBucketDetails);

        // Test
        $decoded = json_decode(json_encode($deliveryBucket), false);

        $bucketDetailsReturned = $decoded->bucket_details;

        $this->assertSame($warehouseId, $bucketDetailsReturned->warehouse_id);
        $this->assertSame($warehouseName, $bucketDetailsReturned->warehouse_name);

        $this->assertSame('2000-01-01', $bucketDetailsReturned->delivery_date);
        $this->assertSame('09:30', $bucketDetailsReturned->shift_start);
        $this->assertSame('16:30', $bucketDetailsReturned->shift_end);
    }
}
