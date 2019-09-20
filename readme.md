# Picup PHP API

This package provides a PHP API for Picup deliveries. We are currently working against v1 of the Picup API.

## Requirements

* Guzzle HTTP Client

## Supported Endpoints

We are currently supporting:

- /integration/quote/one-to-many
- /integration/create/one-to-one
- /integration/add-to-bucket
- /integration/%s/details
- /integration/%s/dispatch-summary

# General Usage

    $guzzle = new Client();
    $apiKey = 'business-123-456';
    $picupApi = new PicupApi($guzzle, $apiKey);
    
    $picupApi->setLive();
    $picupApi->setTesting();

# Api Interface

    public function sendQuoteRequest(DeliveryQuoteRequest $deliveryQuoteRequest): DeliveryQuoteResponse;
    public function sendOrderRequest(DeliveryOrderRequest $deliveryOrderRequest): DeliveryOrderResponse;
    public function sendDeliveryBucket(DeliveryBucket $deliveryBucket): DeliveryOrderResponse;
    public function sendIntegrationDetailsRequest(string $businessId): DeliveryIntegrationDetailsResponse;
    public function sendDispatchSummaryRequest(string $businessId);
