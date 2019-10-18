<?php

declare(strict_types=1);

namespace PicupTechnologies\PicupPHPApi\Responses;

use PicupTechnologies\PicupPHPApi\Objects\DeliveryServiceType;

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
