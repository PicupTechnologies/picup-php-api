<?php

namespace PicupTechnologies\PicupPHPApi;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use PicupTechnologies\PicupPHPApi\Contracts\PicupApiInterface;
use PicupTechnologies\PicupPHPApi\Exceptions\PicupApiException;
use PicupTechnologies\PicupPHPApi\Exceptions\PicupApiKeyInvalid;
use PicupTechnologies\PicupPHPApi\Exceptions\PicupRequestFailed;
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
use PicupTechnologies\PicupPHPApi\Responses\DeliveryIntegrationDetailsResponse;
use PicupTechnologies\PicupPHPApi\Responses\DeliveryOrderResponse;
use PicupTechnologies\PicupPHPApi\Responses\DeliveryQuoteResponse;
use PicupTechnologies\PicupPHPApi\Responses\DispatchSummaryResponse;
use PicupTechnologies\PicupPHPApi\Responses\OrderStatusResponse;

/**
 * PicupApi
 *
 * Communicates with the Picup API
 *
 * @package PicupPHPApi
 * @author Bryan Paddock <bryan@bryan.za.net>
 */
final class PicupApi implements PicupApiInterface
{
    /**
     * @var Client
     */
    private $httpClient;

    /**
     * @var string
     */
    private $apiKey;

    /**
     * @var bool
     */
    private $live = false;

    private $apiPrefix = 'https://otdcpt-knupqa.onthedot.co.za/picup-api/v1';

    private $endpointQuote = '/integration/quote/one-to-many';
    private $endpointOrder = '/integration/create/one-to-many';
    private $endpointAddBucket = '/integration/add-to-bucket';
    private $endpointIntegrationDetails = '/integration/%s/details';
    private $endpointDispatchSummary = '/integration/%s/dispatch-summary';
    private $endpointOrderStatus = '/integration/order-status';

    /**
     * PicupApi constructor.
     *
     * @param Client $httpClient HttpClient to communicate with
     * @param string $apiKey
     */
    public function __construct(Client $httpClient, string $apiKey)
    {
        $this->httpClient = $httpClient;
        $this->apiKey = $apiKey;
    }

    /**
     * Fetches a quick delivery quote from the Picup service
     *
     * @param DeliveryQuoteRequest $deliveryQuoteRequest
     *
     * @return DeliveryQuoteResponse
     *
     * @throws PicupRequestFailed  Should there be a problem with the request
     * @throws PicupApiKeyInvalid  Should the API key be invalid
     * @throws PicupApiException   Should a general problem occur
     */
    public function sendQuoteRequest(DeliveryQuoteRequest $deliveryQuoteRequest): DeliveryQuoteResponse
    {
        $headers = ['api-key' => $this->apiKey];

        try {
            $guzzleResponse = $this->httpClient->post($this->apiPrefix . $this->endpointQuote, [
                'headers' => $headers,
                'json'    => $deliveryQuoteRequest,
            ]);

            $body = $guzzleResponse->getBody()->getContents();

            return DeliveryQuoteResponseFactory::make($body);
        } catch (RequestException $e) {
            $msg = $e->getMessage();
            if ($response = $e->getResponse()) {
                $msg = $response->getBody()->getContents();
                $this->checkResponseForErrors($msg);
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
     * @throws PicupRequestFailed  Should there be a problem with the request
     * @throws PicupApiKeyInvalid  Should the API key be invalid
     * @throws PicupApiException   Should a general problem occur
     */
    public function sendOrderRequest(DeliveryOrderRequest $deliveryOrderRequest): DeliveryOrderResponse
    {
        $headers = ['api-key' => $this->apiKey];

        try {
            $response = $this->httpClient->post($this->apiPrefix . $this->endpointOrder, [
                'headers' => $headers,
                'json'    => $deliveryOrderRequest,
            ]);

            $body = $response->getBody()->getContents();

            return DeliveryOrderResponseFactory::make($body);
        } catch (RequestException $e) {
            $msg = $e->getMessage();
            if ($response = $e->getResponse()) {
                $msg = $response->getBody()->getContents();
                $this->checkResponseForErrors($msg);
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
     * @return DeliveryOrderResponse
     *
     * @throws PicupRequestFailed  Should there be a problem with the request
     * @throws PicupApiKeyInvalid  Should the API key be invalid
     * @throws PicupApiException   Should a general problem occur
     */
    public function sendDeliveryBucket(DeliveryBucketRequest $deliveryBucket): DeliveryOrderResponse
    {
        $headers = ['api-key' => $this->apiKey];

        try {
            $response = $this->httpClient->post($this->apiPrefix . $this->endpointAddBucket, [
                'headers' => $headers,
                'json'    => $deliveryBucket,
            ]);

            $body = $response->getBody()->getContents();

            return DeliveryOrderResponseFactory::make($body);
        } catch (RequestException $e) {
            $msg = $e->getMessage();
            if ($response = $e->getResponse()) {
                $msg = $response->getBody()->getContents();
                $this->checkResponseForErrors($msg);
            }
            $errorMessage = 'DeliveryBucket Error: ' . $msg;

            throw new PicupRequestFailed($deliveryBucket, $errorMessage);
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
     * @throws PicupRequestFailed  Should there be a problem with the request
     * @throws PicupApiKeyInvalid  Should the API key be invalid
     * @throws PicupApiException   Should a general problem occur
     */
    public function sendIntegrationDetailsRequest(StandardBusinessRequest $businessRequest): DeliveryIntegrationDetailsResponse
    {
        $urlTemplate = $this->apiPrefix . $this->endpointIntegrationDetails;
        $endpoint = sprintf($urlTemplate, $businessRequest->getBusinessId());

        try {
            $response = $this->httpClient->get($endpoint);

            $body = json_decode($response->getBody()->getContents(), true);

            $deliveryIntegrationDetailsResponse = DeliveryIntegrationDetailsResponseFactory::make($body);

            if (!$deliveryIntegrationDetailsResponse->isKeyValid()) {
                throw new PicupApiKeyInvalid($deliveryIntegrationDetailsResponse->getIsKeyValidMessage());
            }

            return $deliveryIntegrationDetailsResponse;
        } catch (RequestException $e) {
            $msg = $e->getMessage();
            if ($response = $e->getResponse()) {
                $msg = $response->getBody()->getContents();
                $this->checkResponseForErrors($msg);
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
     * @throws PicupApiException
     */
    public function sendDispatchSummaryRequest(StandardBusinessRequest $businessRequest): DispatchSummaryResponse
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
                $this->checkResponseForErrors($msg);
            }
            $errorMessage = 'DispatchSummary Error: ' . $msg;

            throw new PicupRequestFailed($businessRequest, $errorMessage);
        }
    }

    /**
     * @param OrderStatusRequest $request
     *
     * @return OrderStatusResponse
     *
     * @throws PicupApiException
     * @throws PicupApiKeyInvalid
     * @throws PicupRequestFailed
     */
    public function sendOrderStatusRequest(OrderStatusRequest $request): OrderStatusResponse
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
                $this->checkResponseForErrors($msg);
            }
            $errorMessage = 'DispatchSummary Error: ' . $msg;

            throw new PicupRequestFailed($request, $errorMessage);
        }
    }

    /**
     * Checks the response from Picup for any errors that should be thrown
     *
     * @param string $response
     *
     * @throws PicupApiKeyInvalid
     * @throws PicupApiException
     */
    private function checkResponseForErrors(string $response): void
    {
        // picup enterprise sometimes responds with message and sometimes Message
        $decoded = array_change_key_case(json_decode($response, true));

        if (!isset($decoded['message'])) {
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
    }

    /**
     * @return string
     */
    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    /**
     * @param string $apiKey
     */
    public function setApiKey(string $apiKey): void
    {
        $this->apiKey = $apiKey;
    }

    /**
     * @return bool
     */
    public function isLive(): bool
    {
        return $this->live;
    }

    /**
     * Sets live mode.
     */
    public function setLive(): void
    {
        $this->live = true;
        $this->apiPrefix = 'https://otdcpt-knupprd.onthedot.co.za/picup-api/v1';
    }

    /**
     * Sets testing mode
     */
    public function setTesting(): void
    {
        $this->live = false;
        $this->apiPrefix = 'https://otdcpt-knupqa.onthedot.co.za/picup-api/v1';
    }

    /**
     * @return string
     */
    public function getApiPrefix(): string
    {
        return $this->apiPrefix;
    }
}
