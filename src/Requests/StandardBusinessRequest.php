<?php

namespace PicupTechnologies\PicupPHPApi\Requests;

use InvalidArgumentException;
use PicupTechnologies\PicupPHPApi\Contracts\PicupRequestInterface;

/**
 * Contains a standard business_id request used in:
 *  - DeliveryIntegrationDetails
 *  - DispatchSummary
 *
 * @package PicupTechnologies\PicupPHPApi\Requests
 */
class StandardBusinessRequest implements PicupRequestInterface
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
        if (strpos($businessId, 'business-') !== 0) {
            throw new InvalidArgumentException('Supplied businessId must begin with the business prefix');
        }
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