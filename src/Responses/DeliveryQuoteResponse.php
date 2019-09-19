<?php

namespace PicupTechnologies\PicupPHPApi\Responses;

use PicupTechnologies\PicupPHPApi\Objects\DeliveryServiceType;

/**
 * Class DeliveryQuoteResponse
 *
 * Holds the full quote response provided by Picup
 *
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
     * @return bool
     */
    public function isValid(): bool
    {
        return $this->valid;
    }

    /**
     * @param bool $valid
     */
    public function setValid(bool $valid): void
    {
        $this->valid = $valid;
    }

    /**
     * @return string
     */
    public function getError(): string
    {
        return $this->error;
    }

    /**
     * @param string $error
     */
    public function setError(string $error): void
    {
        $this->error = $error;
    }

    /**
     * @return DeliveryServiceType[]
     */
    public function getServiceTypes(): array
    {
        return $this->serviceTypes;
    }

    /**
     * @param DeliveryServiceType[] $serviceTypes
     */
    public function setServiceTypes(array $serviceTypes): void
    {
        $this->serviceTypes = $serviceTypes;
    }

    /**
     * @param DeliveryServiceType $deliveryServiceType
     */
    public function addServiceType(DeliveryServiceType $deliveryServiceType): void
    {
        $this->serviceTypes[] = $deliveryServiceType;
    }
}
