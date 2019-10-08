# Picup PHP API

![Test suite badge](https://github.com/PicupTechnologies/picup-php-api/workflows/Run%20phpunit%20testsuite/badge.svg)

This package provides a PHP API for Picup deliveries. We are currently working against v1 of the Picup API.

## Requirements

* Guzzle HTTP Client

## Supported Endpoints

We are currently supporting:

- /integration/quote/one-to-many
- /integration/create/one-to-many
- /integration/add-to-bucket
- /integration/%s/details
- /integration/%s/dispatch-summary
- /integration/order-status

# General Usage
You will be provided with an API key from Picup to enter into the plugin. You will receive a separate
key for testing and live mode.

    $guzzle = new Client();
    $apiKey = 'business-123-456';
    $picupApi = new PicupApi($guzzle, $apiKey);
    
    $picupApi->setLive();
    $picupApi->setTesting();

# Quoting
## Request
This example values provided below are the bare minimum required to obtain a valid quote.

    $quoteRequest = new DeliveryQuoteRequest();
    
    // Setup basics
    $quoteRequest->setMerchantId('merchant-1234-5678');
    $quoteRequest->setScheduledDate(new DateTime('+1 Day'));
    $quoteRequest->setCustomerRef('quote-123');
    
    // Build Sender
    $senderAddress = new DeliverySenderAddress();
    $senderContact = new DeliverySenderContact();
    $senderInstructions = 'Use the red sliding warehouse door';
    
    $senderAddress->setLatitude(5.5555);
    $senderAddress->setLongitude(-19.54324);
    
    $senderContact->setName('John Johnson');
    $senderContact->setPhone('0211234567');
    
    $deliverySender = new DeliverySender($senderAddress, $senderContact, $senderInstructions);
    $quoteRequest->setSender($deliverySender)
    
    // Build Receiver
    $receiverAddress = new DeliveryReceiverAddress();
    $receiverContact = new DeliveryReceiverContact();
    $parcels = new DeliveryParcelCollection();
    $specialInstructions = 'Buzz the gate - code 1234. Mind the step';
    
    $deliveryReceiver = new DeliveryReceiver($receiverAddress, $receiverContact, $parcels, $specialInstructions);
    $quoteRequest->addReceiver($deliveryReceiver);
    
    $quoteResponse = $picupApi->sendQuoteRequest($quoteRequest);

## Response
Once a quote response is returned you can verify its validity:

    $quoteResponse->isValid(); (true/false)

If the Picup is valid, multiple service types will be returned with different costing for each.

    $serviceTypes = $quoteResponse->getServiceTypes();

    foreach ($serviceTypes as $serviceType) {
        $serviceType->getDescription();         // vehicle-car
        $serviceType->getPriceInclusive();      // 110.51
        $serviceType->getPriceExclusive();      // 96.1
        $serviceType->getDistance();            // 4.99
        $serviceType->getDuration();            // 00:17:34
    }

# Picup
## Request

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

# General Requests
The DeliveryIntegrationDetails request and DispatchSummary request is a simple request that only requires a Business Id.

    $request = new StandardBusinessRequest('business-1234-5678');
    $response = $api->sendIntegrationDetailsRequest($request);
    $response = $api->sendDispatchSummaryRequest($request);

# Api Interface

    public function sendQuoteRequest(DeliveryQuoteRequest $deliveryQuoteRequest): DeliveryQuoteResponse;
    public function sendOrderRequest(DeliveryOrderRequest $deliveryOrderRequest): DeliveryOrderResponse;
    public function sendDeliveryBucket(DeliveryBucketRequest $deliveryBucketRequest): DeliveryOrderResponse;
    public function sendIntegrationDetailsRequest(StandardBusinessRequest $request): DeliveryIntegrationDetailsResponse;
    public function sendDispatchSummaryRequest(StandardBusinessRequest $request); DispatchSummeryResponse
