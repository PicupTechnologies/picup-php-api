<?php

namespace PicupTechnologies\PicupPHPApi\Tests\Objects\DeliveryBucket;

use DateTime;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryBucket\DeliveryBucket;
use PHPUnit\Framework\TestCase;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryBucket\DeliveryBucketDetails;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryBucket\DeliveryShipment;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryBucket\DeliveryShipmentAddress;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryBucket\DeliveryShipmentContact;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryBucket\DeliveryShipmentParcel;

class DeliveryBucketTest extends TestCase
{
    public function testShipments(): void
    {
        // Set up
        $consignmentId = 'consignment-555';
        $businessRef = 'business-ref-444';

        // Create
        $deliveryBucket = new DeliveryBucket();

        $shipment = new DeliveryShipment();
        $shipment->setConsignment($consignmentId);
        $shipment->setBusinessReference($businessRef);

        $deliveryShipmentAddress = new DeliveryShipmentAddress();
        $shipment->setAddress($deliveryShipmentAddress);

        $deliveryShipmentContact = new DeliveryShipmentContact();
        $shipment->setContact($deliveryShipmentContact);

        $deliveryShipmentParcel = new DeliveryShipmentParcel();
        $shipment->setParcels([$deliveryShipmentParcel]);
        $shipment->addParcel($deliveryShipmentParcel);

        $deliveryBucket->setShipments([$shipment]);

        $shipmentsReturned = $deliveryBucket->getShipments();
        $shipmentReturned = $shipmentsReturned[0];

        $this->assertEquals($consignmentId, $shipmentReturned->getConsignment());
        $this->assertEquals($businessRef, $shipmentReturned->getBusinessReference());
        $this->assertEquals($deliveryShipmentAddress, $shipmentReturned->getAddress());
        $this->assertEquals($deliveryShipmentContact, $shipmentReturned->getContact());
        $this->assertEquals($deliveryShipmentParcel, $shipmentReturned->getParcels()[0]);
        $this->assertEquals($deliveryShipmentParcel, $shipmentReturned->getParcels()[1]);

        // Test
        $decoded = json_decode(json_encode($deliveryBucket), false);

        $shipmentsDecoded = $decoded->shipments;
        $shipmentDecoded = $shipmentsDecoded[0];

        $this->assertEquals($consignmentId, $shipmentDecoded->consignment);
        $this->assertEquals($businessRef, $shipmentDecoded->business_reference);
    }

    public function testBucketDetails()
    {
        $warehouseId = 'warehouse-123';
        $warehouseName = 'Warehouse Tester';

        // Create
        $deliveryBucket = new DeliveryBucket();

        $bucketDetails = new DeliveryBucketDetails();
        $bucketDetails->setWarehouseId($warehouseId);
        $bucketDetails->setWarehouseName($warehouseName);

        $deliveryDate = new DateTime('01/01/2000 09:30:00');
        $bucketDetails->setDeliveryDate($deliveryDate);

        $shiftStart = new DateTime('01/01/2000 09:30:00');
        $shiftEnd = new DateTime('01/01/2000 16:30:00');

        $bucketDetails->setShiftStart($shiftStart);
        $bucketDetails->setShiftEnd($shiftEnd);

        $deliveryBucket->setBucketDetails($bucketDetails);

        $testBucketDetails = $deliveryBucket->getBucketDetails();
        $this->assertEquals($bucketDetails, $testBucketDetails);

        // Test
        $decoded = json_decode(json_encode($deliveryBucket), false);

        $bucketDetailsReturned = $decoded->bucket_details;

        $this->assertEquals($warehouseId, $bucketDetailsReturned->warehouse_id);
        $this->assertEquals($warehouseName, $bucketDetailsReturned->warehouse_name);

        $this->assertEquals('2000-01-01', $bucketDetailsReturned->delivery_date);
        $this->assertEquals('09:30', $bucketDetailsReturned->shift_start);
        $this->assertEquals('16:30', $bucketDetailsReturned->shift_end);
    }
}
