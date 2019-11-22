<?php

namespace PicupTechnologies\PicupPHPApi\Objects\ThirdParty;

use DateTime;
use JsonSerializable;

/**
 * Class FulfillmentBreakdown
 *
 * @package PicupTechnologies\PicupPHPApi\Objects\ThirdParty
 */
final class FulfillmentBreakdown implements JsonSerializable
{
    /**
     * @var string[]
     */
    private $parcelReferences;

    /**
     * @var string
     */
    private $serviceType;

    /**
     * @var string
     */
    private $courierCode;

    /**
     * @var string
     */
    private $priceIncVat;

    /**
     * @var string
     */
    private $priceExVat;

    /**
     * @var DateTime
     */
    private $collectedBefore;

    /**
     * @var DateTime
     */
    private $deliveredBefore;

    /**
     * @return string[]
     */
    public function getParcelReferences(): array
    {
        return $this->parcelReferences;
    }

    /**
     * @param string[] $parcelReferences
     */
    public function setParcelReferences(array $parcelReferences): void
    {
        $this->parcelReferences = $parcelReferences;
    }

    /**
     * @param string $parcelReference
     */
    public function addParcelReference(string $parcelReference): void
    {
        $this->parcelReferences[] = $parcelReference;
    }

    /**
     * @return string
     */
    public function getServiceType(): string
    {
        return $this->serviceType;
    }

    /**
     * @param string $serviceType
     */
    public function setServiceType(string $serviceType): void
    {
        $this->serviceType = $serviceType;
    }

    /**
     * @return string
     */
    public function getCourierCode(): string
    {
        return $this->courierCode;
    }

    /**
     * @param string $courierCode
     */
    public function setCourierCode(string $courierCode): void
    {
        $this->courierCode = $courierCode;
    }

    /**
     * @return string
     */
    public function getPriceIncVat(): string
    {
        return $this->priceIncVat;
    }

    /**
     * @param string $priceIncVat
     */
    public function setPriceIncVat(string $priceIncVat): void
    {
        $this->priceIncVat = $priceIncVat;
    }

    /**
     * @return string
     */
    public function getPriceExVat(): string
    {
        return $this->priceExVat;
    }

    /**
     * @param string $priceExVat
     */
    public function setPriceExVat(string $priceExVat): void
    {
        $this->priceExVat = $priceExVat;
    }

    /**
     * @return DateTime
     */
    public function getCollectedBefore(): DateTime
    {
        return $this->collectedBefore;
    }

    /**
     * @param DateTime $collectedBefore
     */
    public function setCollectedBefore(DateTime $collectedBefore): void
    {
        $this->collectedBefore = $collectedBefore;
    }

    /**
     * @return DateTime
     */
    public function getDeliveredBefore(): DateTime
    {
        return $this->deliveredBefore;
    }

    /**
     * @param DateTime $deliveredBefore
     */
    public function setDeliveredBefore(DateTime $deliveredBefore): void
    {
        $this->deliveredBefore = $deliveredBefore;
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
        return [
            'parcel_references' => $this->getParcelReferences(),
            'service_type' => $this->getServiceType(),
            'courier_code' => $this->getCourierCode(),
            'price_incl_vat' => $this->getPriceIncVat(),
            'price_ex_vat' => $this->getPriceExVat(),
            'collected_before' => $this->getCollectedBefore()->format('Y-m-d\TH:i:s\Z'),
            'delivered_before' => $this->getDeliveredBefore()->format('Y-m-d\TH:i:s\Z'),
        ];
    }
}
