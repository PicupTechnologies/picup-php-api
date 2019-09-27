<?php
/**
 * Created by PhpStorm.
 * User: bryan
 * Date: 2018/07/26
 * Time: 2:26 PM
 */

namespace PicupTechnologies\PicupPHPApi\Contracts;

use PicupTechnologies\PicupPHPApi\Requests\DeliveryBucketRequest;
use PicupTechnologies\PicupPHPApi\Requests\DeliveryOrderRequest;
use PicupTechnologies\PicupPHPApi\Requests\DeliveryQuoteRequest;
use PicupTechnologies\PicupPHPApi\Responses\DeliveryIntegrationDetailsResponse;
use PicupTechnologies\PicupPHPApi\Responses\DeliveryOrderResponse;
use PicupTechnologies\PicupPHPApi\Responses\DeliveryQuoteResponse;

interface PicupApiInterface
{
    /**
     * Sends a Quote Request to the delivery system
     *
     * @param DeliveryQuoteRequest $deliveryQuoteRequest
     *
     * @return DeliveryQuoteResponse
     */
    public function sendQuoteRequest(DeliveryQuoteRequest $deliveryQuoteRequest): DeliveryQuoteResponse;

    /**
     * Sends the QuoteRequest to the delivery system
     *
     * @param DeliveryOrderRequest $deliveryOrderRequest
     *
     * @return DeliveryOrderResponse
     */
    public function sendOrderRequest(DeliveryOrderRequest $deliveryOrderRequest): DeliveryOrderResponse;

    /**
     * Sends the DeliveryBucket to the AddToBucket endpoint
     *
     * @param DeliveryBucketRequest $deliveryBucket
     *
     * @return DeliveryOrderResponse
     */
    public function sendDeliveryBucket(DeliveryBucketRequest $deliveryBucket): DeliveryOrderResponse;

    /**
     * Requests integration details for a given business ID
     *
     * @param string $businessId
     *
     * @return DeliveryIntegrationDetailsResponse
     */
    public function sendIntegrationDetailsRequest(string $businessId): DeliveryIntegrationDetailsResponse;

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
     */
    public function sendDispatchSummaryRequest(string $businessId);
}
