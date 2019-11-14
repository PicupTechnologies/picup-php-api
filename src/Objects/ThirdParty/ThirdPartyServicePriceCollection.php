<?php

namespace PicupTechnologies\PicupPHPApi\Objects\ThirdParty;

use JsonSerializable;

final class ThirdPartyServicePriceCollection implements JsonSerializable
{
    /**
     * @var ThirdPartyServicePrice[]
     */
    private $servicePrices;

    /**
     * @return ThirdPartyServicePrice[]
     */
    public function getServicePrices(): array
    {
        return $this->servicePrices;
    }

    /**
     * @param ThirdPartyServicePrice[] $servicePrices
     */
    public function setServicePrices(array $servicePrices): void
    {
        $this->servicePrices = $servicePrices;
    }

    public function addServicePrices(ThirdPartyServicePrice $servicePrice): void
    {
        $this->servicePrices[] = $servicePrice;
    }

    /**
     * Specify data which should be serialized to JSON
     *
     * @link  https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return $this->getServicePrices();
    }
}
