<?php

declare(strict_types=1);

namespace PicupTechnologies\PicupPHPApi\Contracts;

use PicupTechnologies\PicupPHPApi\Requests\DeliveryBucketRequest;
use PicupTechnologies\PicupPHPApi\Requests\DeliveryOrderRequest;
use PicupTechnologies\PicupPHPApi\Requests\DeliveryQuoteRequest;
use PicupTechnologies\PicupPHPApi\Requests\StandardBusinessRequest;
use PicupTechnologies\PicupPHPApi\Requests\ThirdPartyCollectionRequest;
use PicupTechnologies\PicupPHPApi\Responses\DeliveryBucketResponse;
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
    public function sendQuoteRequest(DeliveryQuoteRequest $deliveryQuoteRequest) : DeliveryQuoteResponse;

    /**
     * Sends the QuoteRequest to the delivery system
     *
     * @param DeliveryOrderRequest $deliveryOrderRequest
     *
     * @return DeliveryOrderResponse
     */
    public function sendOrderRequest(DeliveryOrderRequest $deliveryOrderRequest) : DeliveryOrderResponse;

    /**
     * Sends the DeliveryBucket to the AddToBucket endpoint
     *
     * @param DeliveryBucketRequest $deliveryBucket
     *
     * @return DeliveryBucketResponse
     */
    public function sendDeliveryBucket(DeliveryBucketRequest $deliveryBucket) : DeliveryBucketResponse;

    /**
     * Sends the Third Party Courier Collection Request to Picup
     *
     * @param ThirdPartyCollectionRequest $thirdPartyCollectionRequest
     *
     * @return DeliveryOrderResponse
     */
    public function sendThirdPartyCourierCollection(ThirdPartyCollectionRequest $thirdPartyCollectionRequest): DeliveryOrderResponse;

    /**
     * Requests integration details for a given business ID
     *
     * @param StandardBusinessRequest $businessRequest
     *
     * @return DeliveryIntegrationDetailsResponse
     */
    public function sendIntegrationDetailsRequest(StandardBusinessRequest $businessRequest) : DeliveryIntegrationDetailsResponse;

    /**
     * Returns a list of all the current open Picups, including:
     *
     *  - Total Parcels
     *  - Pending Parcels
     *  - Completed Parcels
     *  - Failed Parcels
     *
     * @param StandardBusinessRequest $businessRequest
     */
    public function sendDispatchSummaryRequest(StandardBusinessRequest $businessRequest);
}
