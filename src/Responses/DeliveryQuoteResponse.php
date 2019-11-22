<?php

declare(strict_types=1);

namespace PicupTechnologies\PicupPHPApi\Responses;

use PicupTechnologies\PicupPHPApi\Objects\DeliveryServiceType;
use PicupTechnologies\PicupPHPApi\Objects\ThirdParty\ThirdPartyResponse;

/**
 * Holds the full quote response provided by Picup
 *
 * @package PicupTechnologies\PicupPHPApi\Responses
 */
final class DeliveryQuoteResponse
{
    /**
     * Is this Picup valid?
     *
     * @var bool
     */
    private $valid = false;

    /**
     * @var string
     */
    private $error;

    /**
     * @var DeliveryServiceType[]
     */
    private $serviceTypes;

    /**
     * @var ThirdPartyResponse
     */
    private $thirdPartyResponse;

    public function isValid() : bool
    {
        return $this->valid;
    }

    public function setValid(bool $valid) : void
    {
        $this->valid = $valid;
    }

    public function getError() : ?string
    {
        return $this->error;
    }

    public function setError(string $error) : void
    {
        $this->error = $error;
    }

    /**
     * @return ThirdPartyResponse|null
     */
    public function getThirdPartyResponse(): ?ThirdPartyResponse
    {
        return $this->thirdPartyResponse;
    }

    /**
     * @param ThirdPartyResponse $thirdPartyResponse
     */
    public function setThirdPartyResponse(ThirdPartyResponse $thirdPartyResponse): void
    {
        $this->thirdPartyResponse = $thirdPartyResponse;
    }

    /**
     * @return DeliveryServiceType[]
     */
    public function getServiceTypes() : ?array
    {
        return $this->serviceTypes;
    }

    /**
     * @param DeliveryServiceType[] $serviceTypes
     */
    public function setServiceTypes(array $serviceTypes) : void
    {
        $this->serviceTypes = $serviceTypes;
    }

    public function addServiceType(DeliveryServiceType $deliveryServiceType) : void
    {
        $this->serviceTypes[] = $deliveryServiceType;
    }
}
