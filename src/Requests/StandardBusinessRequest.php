<?php

namespace PicupTechnologies\PicupPHPApi\Requests;

use PicupTechnologies\PicupPHPApi\Contracts\PicupRequest;

/**
 * Contains a standard business_id request used in:
 *  - DeliveryIntegrationDetails
 *  - DispatchSummary
 *
 * @package PicupTechnologies\PicupPHPApi\Requests
 */
class StandardBusinessRequest implements PicupRequest
{
    /**
     * @var string UUID of business id
     */
    private $businessId;

    /**
     * DeliveryIntegrationDetailsRequest constructor.
     *
     * @param string $businessId
     */
    public function __construct(string $businessId)
    {
        $this->businessId = $businessId;
    }

    /**
     * @return string
     */
    public function getBusinessId(): string
    {
        return $this->businessId;
    }
}
