# AddToBucket

This is used to create a bucket with Picup.

# Usage

First you need to create a DeliveryBucket which will be sent to Picup.

## Creating Bucket
 
    // 1. Build Bucket Details
    $deliveryBucketDetails = new DeliveryBucketDetails();
    $deliveryBucketDetails->setWarehouseId($warehouseId);
    $deliveryBucketDetails->setDeliveryDate($deliveryShift->getShiftStartDate());
    $deliveryBucketDetails->setShiftStart($deliveryShift->getShiftStartDate());
    $deliveryBucketDetails->setShiftEnd($deliveryShift->getShiftEndDate());
    
    // 2. Build Shipments
    $deliveryShipmentAddress = new DeliveryShipmentAddress();
    $deliveryShipmentAddress->setAddressLine1($order->shippingAddress->getAddress1());
    $deliveryShipmentAddress->setAddressLine2($order->shippingAddress->getAddress2());
    $deliveryShipmentAddress->setCity($order->shippingAddress->getCity());
    $deliveryShipmentAddress->setCountry($order->shippingAddress->getCountry());
    $deliveryShipmentAddress->setLatitude($order->shippingAddress->getLatitude());
    $deliveryShipmentAddress->setLongitude($order->shippingAddress->getLongitude());
  
    $deliveryShipmentContact = new DeliveryShipmentContact();
    $deliveryShipmentContact->setCustomerName($order->shippingAddress->getName());
    $deliveryShipmentContact->setCustomerPhone($order->shippingAddress->getPhone());
    
    $deliveryShipment = new DeliveryShipment();
    
    $deliveryShipment->setConsignment('consignment-123');
    $deliveryShipment->setBusinessReference('order-123');
    $deliveryShipment->setAddress($deliveryShipmentAddress);
    $deliveryShipment->setContact($deliveryShipmentContact);
    
    $parcel = new DeliveryShipmentParcel();
    $parcel->setSize(ParcelSizeEnum::ParcelMedium);
    $parcel->setTrackingNumber('tracking-number-123');
    $deliveryShipment->addParcel($parcel);
    
    $deliveryBucket = new DeliveryBucket();
    $deliveryBucket->setBucketDetails($deliveryBucketDetails);
    $deliveryBucket->setShipments([$deliveryShipment]);

## Sending Bucket

    $response = $deliveryService->sendDeliveryBucket($deliveryBucket);
