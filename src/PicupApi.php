<?php

namespace PicupTechnologies\PicupPHPApi;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use PicupTechnologies\PicupPHPApi\Contracts\PicupApiInterface;
use PicupTechnologies\PicupPHPApi\Exceptions\PicupApiException;
use PicupTechnologies\PicupPHPApi\Exceptions\PicupApiKeyInvalid;
use PicupTechnologies\PicupPHPApi\Factories\DeliveryIntegrationDetailsResponseFactory;
use PicupTechnologies\PicupPHPApi\Factories\DeliveryOrderResponseFactory;
use PicupTechnologies\PicupPHPApi\Factories\DeliveryQuoteResponseFactory;
use PicupTechnologies\PicupPHPApi\Requests\DeliveryBucketRequest;
use PicupTechnologies\PicupPHPApi\Requests\DeliveryOrderRequest;
use PicupTechnologies\PicupPHPApi\Requests\DeliveryQuoteRequest;
use PicupTechnologies\PicupPHPApi\Responses\DeliveryIntegrationDetailsResponse;
use PicupTechnologies\PicupPHPApi\Responses\DeliveryOrderResponse;
use PicupTechnologies\PicupPHPApi\Responses\DeliveryQuoteResponse;

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
    private $endpointOrder = '/integration/create/one-to-one';
    private $endpointAddBucket = '/integration/add-to-bucket';
    private $endpointIntegrationDetails = '/integration/%s/details';
    private $endpointDispatchSummary = '/integration/%s/dispatch-summary';

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
     * @throws PicupApiException
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
            }
            $errorMessage = 'QuoteRequest Error: ' . $msg;

            throw new PicupApiException($errorMessage);
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
     * @throws PicupApiException
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
            }
            $errorMessage = 'OrderRequest Error: ' . $msg;

            throw new PicupApiException($errorMessage);
        }
    }

    /**
     * Sends the DeliveryBucket to Picup to perform the actual delivery of a shipment
     *
     * Warning: This sends the delivery to Picup for actual delivery!
     *
     * @param DeliveryBucketRequest $deliveryBucket
     *
     * @return DeliveryOrderResponse
     * @throws PicupApiException
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
            }
            $errorMessage = 'DeliveryBucket Error: ' . $msg;

            throw new PicupApiException($errorMessage);
        }
    }

    /**
     * Fetches the integration details for a given business ID
     *
     * This returns the list of warehouses
     *
     * @param string $businessId
     *
     * @return DeliveryIntegrationDetailsResponse
     * @throws PicupApiKeyInvalid
     * @throws PicupApiException
     */
    public function sendIntegrationDetailsRequest(string $businessId): DeliveryIntegrationDetailsResponse
    {
        $urlTemplate = $this->apiPrefix . $this->endpointIntegrationDetails;
        $endpoint = sprintf($urlTemplate, $businessId);

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
            }

            $bodyResponse = json_decode($msg, false);

            if (stripos($bodyResponse->Message, 'Identity is invalid') !== false) {
                throw new PicupApiKeyInvalid($bodyResponse->Message);
            }

            $errorMessage = 'IntegrationDetails Error: ' . $bodyResponse->Message;
            throw new PicupApiException($errorMessage);
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
     * @param string $businessId
     *
     * @return mixed
     * @throws PicupApiException
     */
    public function sendDispatchSummaryRequest(string $businessId)
    {
        $headers = ['api-key' => $this->apiKey];
        $urlTemplate = $this->apiPrefix . $this->endpointDispatchSummary;
        $endpoint = sprintf($urlTemplate, $businessId);

        try {
            $response = $this->httpClient->get($endpoint, [
                'headers' => $headers,
            ]);

            return $response->getBody()->getContents();
        } catch (RequestException $e) {
            $msg = $e->getMessage();
            if ($response = $e->getResponse()) {
                $msg = $response->getBody()->getContents();
            }
            $errorMessage = 'DispatchSummary Error: ' . $msg;

            throw new PicupApiException($errorMessage);
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
