<?php

declare(strict_types=1);

namespace PicupTechnologies\PicupPHPApi;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use PicupTechnologies\PicupPHPApi\Contracts\PicupApiInterface;
use PicupTechnologies\PicupPHPApi\Contracts\PicupRequestInterface;
use PicupTechnologies\PicupPHPApi\Exceptions\PicupApiException;
use PicupTechnologies\PicupPHPApi\Exceptions\PicupApiKeyInvalid;
use PicupTechnologies\PicupPHPApi\Exceptions\PicupRequestFailed;
use PicupTechnologies\PicupPHPApi\Exceptions\ValidationException;
use PicupTechnologies\PicupPHPApi\Factories\DeliveryBucketResponseFactory;
use PicupTechnologies\PicupPHPApi\Factories\DeliveryIntegrationDetailsResponseFactory;
use PicupTechnologies\PicupPHPApi\Factories\DeliveryOrderResponseFactory;
use PicupTechnologies\PicupPHPApi\Factories\DeliveryQuoteResponseFactory;
use PicupTechnologies\PicupPHPApi\Factories\DispatchSummaryResponseFactory;
use PicupTechnologies\PicupPHPApi\Factories\OrderStatusResponseFactory;
use PicupTechnologies\PicupPHPApi\Requests\DeliveryBucketRequest;
use PicupTechnologies\PicupPHPApi\Requests\DeliveryOrderRequest;
use PicupTechnologies\PicupPHPApi\Requests\DeliveryQuoteRequest;
use PicupTechnologies\PicupPHPApi\Requests\OrderStatusRequest;
use PicupTechnologies\PicupPHPApi\Requests\StandardBusinessRequest;
use PicupTechnologies\PicupPHPApi\Requests\ThirdPartyCollectionRequest;
use PicupTechnologies\PicupPHPApi\Responses\DeliveryBucketResponse;
use PicupTechnologies\PicupPHPApi\Responses\DeliveryIntegrationDetailsResponse;
use PicupTechnologies\PicupPHPApi\Responses\DeliveryOrderResponse;
use PicupTechnologies\PicupPHPApi\Responses\DeliveryQuoteResponse;
use PicupTechnologies\PicupPHPApi\Responses\DispatchSummaryResponse;
use PicupTechnologies\PicupPHPApi\Responses\OrderStatusResponse;

/**
 * Picup API
 *
 * Communicates with the Picup API to provide Shipping Rates and
 * create deliveries.
 *
 * @package PicupTechnologies\PicupPHPApi
 */
final class PicupApi implements PicupApiInterface
{
    /**
     * @var Client HttpClient to use to communicate with
     */
    private $httpClient;

    /**
     * @var string Live API Key from Picup
     */
    private $liveApiKey;

    /**
     * @var string Testing API Key from Picup
     */
    private $testApiKey;

    /**
     * @var string The API key that is currently in use
     */
    private $apiKey;

    /**
     * @var bool
     */
    private $live = false;

    /**
     * @var string Current API host prefix
     */
    private $apiPrefix = 'https://otdcpt-knupqa.onthedot.co.za/picup-api/v1';

    private $endpointQuote = '/integration/quote/one-to-many';
    private $endpointOrder = '/integration/create/one-to-many';
    private $endpointThirdPartyCollection = '/integration/create/courier-collection';
    private $endpointAddBucket = '/integration/add-to-bucket';
    private $endpointIntegrationDetails = '/integration/%s/details';
    private $endpointDispatchSummary = '/integration/%s/dispatch-summary';
    private $endpointOrderStatus = '/integration/order-status';

    /**
     * PicupApi constructor.
     *
     * We default to testing mode so the client must setLive() manually.
     *
     * @param Client $httpClient HttpClient to communicate with
     * @param string $liveApiKey Live API key
     * @param string $testApiKey Testing API key
     */
    public function __construct(Client $httpClient, string $liveApiKey, string $testApiKey)
    {
        $this->httpClient = $httpClient;
        $this->liveApiKey = $liveApiKey;
        $this->testApiKey = $testApiKey;

        // default to testing
        $this->apiKey = $testApiKey;
    }

    /**
     * Fetches a quick delivery quote from the Picup service
     *
     * @param DeliveryQuoteRequest $deliveryQuoteRequest
     *
     * @return DeliveryQuoteResponse
     *
     * @throws PicupApiKeyInvalid Should the API key be invalid
     * @throws PicupRequestFailed Should there be a problem with the request
     * @throws PicupApiException  Should there be a general problem with the API
     */
    public function sendQuoteRequest(DeliveryQuoteRequest $deliveryQuoteRequest) : DeliveryQuoteResponse
    {
        $headers = ['api-key' => $this->apiKey];

        try {
            $guzzleResponse = $this->httpClient->post($this->apiPrefix . $this->endpointQuote, [
                'headers' => $headers,
                'json' => $deliveryQuoteRequest,
            ]);

            $body = $guzzleResponse->getBody()->getContents();

            return DeliveryQuoteResponseFactory::make($body);
        } catch (RequestException $e) {
            $msg = $e->getMessage();
            if ($response = $e->getResponse()) {
                $msg = $response->getBody()->getContents();
                $this->checkResponseForErrors($msg, $deliveryQuoteRequest);
            }
            $errorMessage = 'QuoteRequest Error: ' . $msg;

            throw new PicupRequestFailed($deliveryQuoteRequest, $errorMessage);
        }
    }

    /**
     * Sends an Order Request to Picup
     *
     * Warning: This sends the delivery to Picup for actual delivery!
     *
     * @param DeliveryOrderRequest $deliveryOrderRequest
     *
     * @return DeliveryOrderResponse Containing the request_id
     *
     * @throws PicupApiKeyInvalid Should the API key be invalid
     * @throws PicupRequestFailed Should there be a problem with the request
     * @throws PicupApiException  Should there be a general problem with the API
     */
    public function sendOrderRequest(DeliveryOrderRequest $deliveryOrderRequest) : DeliveryOrderResponse
    {
        $headers = ['api-key' => $this->apiKey];

        try {
            $response = $this->httpClient->post($this->apiPrefix . $this->endpointOrder, [
                'headers' => $headers,
                'json' => $deliveryOrderRequest,
            ]);

            $body = $response->getBody()->getContents();

            return DeliveryOrderResponseFactory::make($body);
        } catch (RequestException $e) {
            $msg = $e->getMessage();
            if ($response = $e->getResponse()) {
                $msg = $response->getBody()->getContents();
                $this->checkResponseForErrors($msg, $deliveryOrderRequest);
            }
            $errorMessage = 'OrderRequest Error: ' . $msg;

            throw new PicupRequestFailed($deliveryOrderRequest, $errorMessage);
        }
    }

    /**
     * Picup Enterprise is able to group multiple orders for a delivery
     * into a "bucket" for processing. A bucket allows for multiple
     * configurations of picup routes to be set, preferences and scheduling.
     *
     * Each order requires a unique Business Reference
     *
     * If the bucket details vary, a new bucket will be created.
     *
     * The warehouseId corresponds to the collection warehouse which will be
     * set up during the enterprise business creation.
     *
     * Buckets can be dispatched when ready, after processing, costing and routing.
     *
     * Created buckets are available for viewing at:
     * http://enterprise.codependent.digital/dashboard/buckets
     *
     * Warning: This sends the delivery to Picup for actual delivery!
     *
     * @param DeliveryBucketRequest $deliveryBucket
     *
     * @return DeliveryBucketResponse
     *
     * @throws PicupApiKeyInvalid Should the API key be invalid
     * @throws PicupRequestFailed Should there be a problem with the request
     * @throws PicupApiException  Should there be a general problem with the API
     */
    public function sendDeliveryBucket(DeliveryBucketRequest $deliveryBucket) : DeliveryBucketResponse
    {
        $headers = ['api-key' => $this->apiKey];

        try {
            $response = $this->httpClient->post($this->apiPrefix . $this->endpointAddBucket, [
                'headers' => $headers,
                'json' => $deliveryBucket,
            ]);

            $body = $response->getBody()->getContents();

            return DeliveryBucketResponseFactory::make($body);
        } catch (RequestException $e) {
            $msg = $e->getMessage();
            if ($response = $e->getResponse()) {
                $msg = $response->getBody()->getContents();
                $this->checkResponseForErrors($msg, $deliveryBucket);
            }
            $errorMessage = 'DeliveryBucket Error: ' . $msg;

            throw new PicupRequestFailed($deliveryBucket, $errorMessage);
        }
    }

    /**
     * @param ThirdPartyCollectionRequest $thirdPartyCollectionRequest
     *
     * @return DeliveryOrderResponse
     * @throws PicupApiException
     * @throws PicupApiKeyInvalid
     * @throws PicupRequestFailed
     * @throws ValidationException
     */
    public function sendThirdPartyCourierCollection(ThirdPartyCollectionRequest $thirdPartyCollectionRequest): DeliveryOrderResponse
    {
        $headers = ['api-key' => $this->apiKey];

        try {
            $response = $this->httpClient->post($this->apiPrefix . $this->endpointThirdPartyCollection, [
                'headers' => $headers,
                'json' => $thirdPartyCollectionRequest,
            ]);

            $body = $response->getBody()->getContents();

            return DeliveryOrderResponseFactory::make($body);
        } catch (RequestException $e) {
            $msg = $e->getMessage();
            if ($response = $e->getResponse()) {
                $msg = $response->getBody()->getContents();
                $this->checkResponseForErrors($msg, $thirdPartyCollectionRequest);
            }
            $errorMessage = 'DeliveryBucket Error: ' . $msg;

            throw new PicupRequestFailed($thirdPartyCollectionRequest, $errorMessage);
        }
    }

    /**
     * The Business Details call is a simple call, often useful to test
     * your settings.
     *
     * When successful, this call will return your authorization request, as
     * well as our standard parcel sizes and any warehouses linked to your
     * account.
     *
     * @param StandardBusinessRequest $businessRequest
     *
     * @return DeliveryIntegrationDetailsResponse
     *
     * @throws PicupApiKeyInvalid Should the API key be invalid
     * @throws PicupRequestFailed Should there be a problem with the request
     * @throws PicupApiException  Should there be a general problem with the API
     */
    public function sendIntegrationDetailsRequest(StandardBusinessRequest $businessRequest) : DeliveryIntegrationDetailsResponse
    {
        $urlTemplate = $this->apiPrefix . $this->endpointIntegrationDetails;
        $endpoint = sprintf($urlTemplate, $businessRequest->getBusinessId());

        try {
            $response = $this->httpClient->get($endpoint);

            $body = json_decode($response->getBody()->getContents(), true);

            $deliveryIntegrationDetailsResponse = DeliveryIntegrationDetailsResponseFactory::make($body);

            if (! $deliveryIntegrationDetailsResponse->isKeyValid()) {
                throw new PicupApiKeyInvalid($deliveryIntegrationDetailsResponse->getIsKeyValidMessage());
            }

            return $deliveryIntegrationDetailsResponse;
        } catch (RequestException $e) {
            $msg = $e->getMessage();
            if ($response = $e->getResponse()) {
                $msg = $response->getBody()->getContents();
                $this->checkResponseForErrors($msg, $businessRequest);
            }

            $errorMessage = 'IntegrationDetails Error: ' . $msg;

            throw new PicupRequestFailed($businessRequest, $errorMessage);
        }
    }

    /**
     * Returns a list of all the current open Picups, including:
     *
     *  - Total Parcels
     *  - Pending Parcels
     *  - Completed Parcels
     *  - Failed Parcels
     *
     * @param StandardBusinessRequest $businessRequest
     *
     * @return DispatchSummaryResponse
     *
     * @throws PicupApiKeyInvalid Should the API key be invalid
     * @throws PicupRequestFailed Should there be a problem with the request
     * @throws PicupApiException  Should there be a general problem with the API
     */
    public function sendDispatchSummaryRequest(StandardBusinessRequest $businessRequest) : DispatchSummaryResponse
    {
        $headers = ['api-key' => $this->apiKey];
        $urlTemplate = $this->apiPrefix . $this->endpointDispatchSummary;
        $endpoint = sprintf($urlTemplate, $businessRequest->getBusinessId());

        try {
            $response = $this->httpClient->get($endpoint, [
                'headers' => $headers,
            ]);

            $body = json_decode($response->getBody()->getContents(), true);

            return DispatchSummaryResponseFactory::make($body);
        } catch (RequestException $e) {
            $msg = $e->getMessage();
            if ($response = $e->getResponse()) {
                $msg = $response->getBody()->getContents();
                $this->checkResponseForErrors($msg, $businessRequest);
            }
            $errorMessage = 'DispatchSummary Error: ' . $msg;

            throw new PicupRequestFailed($businessRequest, $errorMessage);
        }
    }

    /**
     * Fetches the status for an order
     *
     * @param OrderStatusRequest $request
     *
     * @return OrderStatusResponse
     *
     * @throws PicupApiKeyInvalid Should the API key be invalid
     * @throws PicupRequestFailed Should there be a problem with the request
     * @throws PicupApiException  Should there be a general problem with the API
     */
    public function sendOrderStatusRequest(OrderStatusRequest $request) : OrderStatusResponse
    {
        $headers = ['api-key' => $this->apiKey];
        $endpoint = $this->apiPrefix . $this->endpointOrderStatus;

        try {
            $response = $this->httpClient->post($endpoint, [
                'headers' => $headers,
                'json' => $request,
            ]);

            $body = json_decode($response->getBody()->getContents(), true);

            return OrderStatusResponseFactory::make($body);
        } catch (RequestException $e) {
            $msg = $e->getMessage();
            if ($response = $e->getResponse()) {
                $msg = $response->getBody()->getContents();
                $this->checkResponseForErrors($msg, $request);
            }
            $errorMessage = 'DispatchSummary Error: ' . $msg;

            throw new PicupRequestFailed($request, $errorMessage);
        }
    }

    /**
     * Returns the API key
     *
     * @return string
     */
    public function getApiKey() : string
    {
        return $this->apiKey;
    }

    /**
     * Sets the API key
     *
     * @param string $apiKey
     */
    public function setApiKey(string $apiKey) : void
    {
        $this->apiKey = $apiKey;
    }

    /**
     * Returns boolean indicating live mode status
     *
     * @return bool
     */
    public function isLive() : bool
    {
        return $this->live;
    }

    /**
     * Sets live mode
     */
    public function setLive() : void
    {
        $this->live = true;
        $this->apiKey = $this->liveApiKey;
        $this->apiPrefix = 'https://otdcpt-knupprd.onthedot.co.za/picup-api/v1';
    }

    /**
     * Sets testing mode
     */
    public function setTesting() : void
    {
        $this->live = false;
        $this->apiKey = $this->testApiKey;
        $this->apiPrefix = 'https://otdcpt-knupqa.onthedot.co.za/picup-api/v1';
    }

    /**
     * Returns the current API url prefix
     *
     * @return string
     */
    public function getApiPrefix() : string
    {
        return $this->apiPrefix;
    }

    /**
     * Checks the response from Picup for any errors that should be thrown
     *
     * @param string                $response
     *
     * @param PicupRequestInterface $picupRequest
     *
     * @throws PicupApiException
     * @throws PicupApiKeyInvalid
     * @throws ValidationException
     */
    private function checkResponseForErrors(string $response, PicupRequestInterface $picupRequest) : void
    {
        $jsonDecoded = json_decode($response, true);

        if ($jsonDecoded === null) {
            throw new PicupApiException('Response from Picup does not contain valid JSON');
        }

        // picup enterprise sometimes responds with message and sometimes Message
        $decoded = array_change_key_case($jsonDecoded);

        if (! isset($decoded['message'])) {
            return;
        }

        // Key is malformed
        if (stripos($decoded['message'], 'Identity is invalid') !== false) {
            throw new PicupApiKeyInvalid($decoded['message']);
        }

        // Key is incorrect
        if (stripos($decoded['message'], 'Authorization has been denied') !== false) {
            throw new PicupApiKeyInvalid($decoded['message']);
        }

        // Validation errors
        if (stripos($decoded['message'], 'Model validation failed') !== false) {
            throw new ValidationException($picupRequest, $decoded['message'], $decoded['validation_errors']);
        }
    }
}
