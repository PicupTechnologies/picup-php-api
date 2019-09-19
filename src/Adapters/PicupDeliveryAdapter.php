<?php

namespace PicupTechnologies\PicupPHPApi\Adapters;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use PicupTechnologies\PicupPHPApi\Contracts\DeliveryAdapterInterface;
use PicupTechnologies\PicupPHPApi\Exceptions\AdapterException;
use PicupTechnologies\PicupPHPApi\Exceptions\OrderRequestFailed;
use PicupTechnologies\PicupPHPApi\Exceptions\PicupApiKeyInvalid;
use PicupTechnologies\PicupPHPApi\Exceptions\QuoteRequestFailed;
use PicupTechnologies\PicupPHPApi\Factories\DeliveryIntegrationDetailsResponseFactory;
use PicupTechnologies\PicupPHPApi\Factories\DeliveryQuoteResponseFactory;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryBucket\DeliveryBucket;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryIntegrationDetailsResponse;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryOrderRequest;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryOrderResponse;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryQuoteRequest;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryQuoteResponse;

/**
 * PicupDeliveryAdapter
 *
 * Uses Picup as the Delivery System
 *
 * @package App\DeliveryAdapters
 */
final class PicupDeliveryAdapter implements DeliveryAdapterInterface
{
    /**
     * @var Client
     */
    private $httpClient;

    /**
     * PicupDeliveryAdapter constructor.
     *
     * @param Client $httpClient HttpClient to communicate with
     */
    public function __construct(Client $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * Fetches a quick delivery quote from the Picup service
     *
     * @param DeliveryQuoteRequest $deliveryQuoteRequest
     *
     * @return DeliveryQuoteResponse
     * @throws QuoteRequestFailed
     */
    public function sendQuoteRequest(DeliveryQuoteRequest $deliveryQuoteRequest): DeliveryQuoteResponse
    {
        $endpoint = 'https://otdcpt-knupqa.onthedot.co.za/picup-api/v1/integration/quote/one-to-many';

        $headers = [
            'api-key' => 'business-06fcabf7-66c8-4f7f-a0d1-5035bc32d1ee',
        ];

        try {
            $guzzleResponse = $this->httpClient->post($endpoint, [
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
            $errorMessage = 'QuoteRequest API Error: ' . $msg;

            throw new QuoteRequestFailed($deliveryQuoteRequest, $errorMessage);
        } catch (Exception $e) {
            $msg = $e->getMessage();

            $errorMessage = 'QuoteRequest General Error: ' . $msg;

            throw new QuoteRequestFailed($deliveryQuoteRequest, $errorMessage);
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
     * @throws OrderRequestFailed
     */
    public function sendOrderRequest(DeliveryOrderRequest $deliveryOrderRequest): DeliveryOrderResponse
    {
        $endpoint = 'https://otdcpt-knupqa.onthedot.co.za/picup-api/v1/integration/create/one-to-one';

        $headers = [
            'api-key' => 'business-06fcabf7-66c8-4f7f-a0d1-5035bc32d1ee',
        ];

        try {
            $response = $this->httpClient->post($endpoint, [
                'headers' => $headers,
                'json'    => $deliveryOrderRequest,
            ]);

            $body = json_decode($response->getBody()->getContents(), true);

            $deliveryOrderResponse = new DeliveryOrderResponse(
                $body->request_id
            );

            return $deliveryOrderResponse;
        } catch (ClientException $e) {
            $msg = $e->getMessage();
            if ($response = $e->getResponse()) {
                $msg = $response->getBody()->getContents();
            }
            $errorMessage = 'OrderRequest Error: ' . $msg;

            throw new OrderRequestFailed($deliveryOrderRequest, $errorMessage);
        }
    }

    /**
     * Sends the DeliveryBucket to Picup to perform the actual delivery of a shipment
     *
     * Warning: This sends the delivery to Picup for actual delivery!
     *
     * @param DeliveryBucket $deliveryBucket
     *
     * @return DeliveryOrderResponse
     * @throws Exception
     */
    public function sendDeliveryBucket(DeliveryBucket $deliveryBucket): DeliveryOrderResponse
    {
        $endpoint = 'https://otdcpt-knupqa.onthedot.co.za/picup-api/v1/integration/add-to-bucket';

        $headers = [
            'api-key' => 'business-06fcabf7-66c8-4f7f-a0d1-5035bc32d1ee',
        ];

        try {
            $response = $this->httpClient->post($endpoint, [
                'headers' => $headers,
                'json'    => $deliveryBucket,
            ]);

            $body = json_decode($response->getBody()->getContents(), true);

            $deliveryOrderResponse = new DeliveryOrderResponse(
                $body->request_id
            );

            return $deliveryOrderResponse;
        } catch (ClientException $e) {
            $msg = $e->getMessage();
            if ($response = $e->getResponse()) {
                $msg = $response->getBody()->getContents();
            }
            $errorMessage = 'DeliveryBucket Error: ' . $msg;

            throw new Exception($errorMessage);
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
     * @throws PicupApiKeyInvalid|Exception
     */
    public function sendIntegrationDetailsRequest(string $businessId): DeliveryIntegrationDetailsResponse
    {
        $urlTemplate = 'https://otdcpt-knupqa.onthedot.co.za/picup-api/v1/integration/%s/details';
        $endpoint = sprintf($urlTemplate, $businessId);

        try {
            $response = $this->httpClient->get($endpoint);

            $body = json_decode($response->getBody()->getContents(), true);

            $deliveryIntegrationDetailsResponse = DeliveryIntegrationDetailsResponseFactory::make($body);

            if (!$deliveryIntegrationDetailsResponse->isKeyValid()) {
                throw new PicupApiKeyInvalid($deliveryIntegrationDetailsResponse->getIsKeyValidMessage());
            }

            return $deliveryIntegrationDetailsResponse;
        } catch (ClientException $e) {
            $msg = $e->getMessage();
            if ($response = $e->getResponse()) {
                $msg = $response->getBody()->getContents();
            }

            $bodyResponse = json_decode($msg, false);

            if (stripos($bodyResponse->message, 'Identity is invalid') !== false) {
                throw new PicupApiKeyInvalid($bodyResponse->message);
            }

            $errorMessage = 'IntegrationDetails Error: ' . $bodyResponse->message;
            throw new Exception($errorMessage);
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
     * @throws Exception
     */
    public function sendDispatchSummaryRequest(string $businessId)
    {
        $urlTemplate = 'https://otdcpt-knupqa.onthedot.co.za/picup-api/v1/integration/%s/dispatch-summary';
        $endpoint = sprintf($urlTemplate, $businessId);

        return $this->sendRequest('get', $endpoint);
    }

    /**
     * @param       $request
     * @param       $endpoint
     * @param array    $headers
     * @param null     $postData
     *
     * @return mixed
     * @throws AdapterException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function sendRequest($request, $endpoint, $headers = [], $postData = null)
    {
        try {
            $options = [
                'headers' => $headers,
                'body' => $postData
            ];
            $response = $this->httpClient->request($request, $endpoint, $options);

            return json_decode($response->getBody()->getContents(), true);
        } catch (ClientException $e) {
            $msg = $e->getMessage();
            if ($response = $e->getResponse()) {
                $msg = $response->getBody()->getContents();
            }

            $bodyResponse = json_decode($msg, false);

            $errorMessage = 'Picup Api Request Error: ' . $bodyResponse->message;

            throw new AdapterException($errorMessage);
        } catch (Exception $e) {
        }
    }
}
