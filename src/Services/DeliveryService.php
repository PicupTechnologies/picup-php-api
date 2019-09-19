<?php
/**
 * Created by PhpStorm.
 * User: bryan
 * Date: 2018/10/24
 * Time: 1:20 PM
 */

namespace PicupTechnologies\PicupPHPApi\Services;

use DateInterval;
use DateTime;
use Exception;
use PicupTechnologies\PicupPHPApi\Contracts\DeliveryAdapterInterface;
use PicupTechnologies\PicupPHPApi\Exceptions\PicupApiKeyInvalid;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryBucket\DeliveryBucket;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryIntegrationDetailsResponse;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryOrderRequest;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryOrderResponse;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryQuoteRequest;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryQuoteResponse;

/**
 * Class DeliveryService
 *
 * Responsible for using the delivery adapter to quote and create orders on the delivery backend
 *
 * @package App\Services
 */
class DeliveryService
{
    /**
     * @var DeliveryAdapterInterface
     */
    private $deliveryAdapter;

    /**
     * DeliveryService constructor.
     *
     * @param DeliveryAdapterInterface $deliveryAdapter
     */
    public function __construct(DeliveryAdapterInterface $deliveryAdapter)
    {
        $this->deliveryAdapter = $deliveryAdapter;
    }

    /**
     * Uses the adapter to send a quote request
     *
     * @param DeliveryQuoteRequest $deliveryQuoteRequest
     *
     * @return DeliveryQuoteResponse
     */
    public function sendQuoteRequest(DeliveryQuoteRequest $deliveryQuoteRequest): DeliveryQuoteResponse
    {
        return $this->deliveryAdapter->sendQuoteRequest($deliveryQuoteRequest);
    }

    /**
     * Uses the adapter to create an order on the delivery system backend
     *
     * @param DeliveryOrderRequest $deliveryOrderRequest
     *
     * @return DeliveryOrderResponse
     */
    public function sendOrderRequest(DeliveryOrderRequest $deliveryOrderRequest): DeliveryOrderResponse
    {
        return $this->deliveryAdapter->sendOrderRequest($deliveryOrderRequest);
    }

    /**
     * Uses the adapter to add to the bucket
     *
     * @param DeliveryBucket $deliveryBucket
     *
     * @return DeliveryOrderResponse
     */
    public function sendDeliveryBucket(DeliveryBucket $deliveryBucket): DeliveryOrderResponse
    {
        return $this->deliveryAdapter->sendDeliveryBucket($deliveryBucket);
    }

    /**
     * @param string $businessId
     *
     * @return DeliveryIntegrationDetailsResponse
     * @throws PicupApiKeyInvalid
     */
    public function fetchIntegrationDetails(string $businessId): DeliveryIntegrationDetailsResponse
    {
        return $this->deliveryAdapter->sendIntegrationDetailsRequest($businessId);
    }
}
