<?php

namespace PicupTechnologies\PicupPHPApi\Objects\ThirdParty;

use JsonSerializable;
use PicupTechnologies\PicupPHPApi\Collections\ThirdPartyCourierCollection;

final class ThirdPartyCollectionCollection implements JsonSerializable
{
    /**
     * @var ThirdPartyFulfillmentCollection[]
     */
    private $collections;

    /**
     * @var ThirdPartyCourierCollection
     */
    private $couriers;

    /**
     * @var string
     */
    private $courierCode;

    /**
     * @var int
     */
    private $serviceType;

    /**
     * @var int
     */
    private $totalQuotes;

    /**
     * @return ThirdPartyFulfillmentCollection[]
     */
    public function getCollections(): array
    {
        return $this->collections;
    }

    /**
     * @param ThirdPartyFulfillmentCollection[] $collections
     */
    public function setCollections(array $collections): void
    {
        $this->collections = $collections;
    }

    /**
     * @param ThirdPartyFulfillmentCollection $collection
     */
    public function addCollection(ThirdPartyFulfillmentCollection $collection): void
    {
        $this->collections[] = $collection;
    }

    /**
     * @return ThirdPartyCourierCollection
     */
    public function getCouriers(): ThirdPartyCourierCollection
    {
        return $this->couriers;
    }

    /**
     * @param ThirdPartyCourierCollection $couriers
     */
    public function setCouriers(ThirdPartyCourierCollection $couriers): void
    {
        $this->couriers = $couriers;
    }

    /**
     * @return string
     */
    public function getCourierCode(): ?string
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
     * @return int
     */
    public function getServiceType(): int
    {
        return $this->serviceType;
    }

    /**
     * @param int $serviceType
     */
    public function setServiceType(int $serviceType): void
    {
        $this->serviceType = $serviceType;
    }

    /**
     * @return int
     */
    public function getTotalQuotes(): ?int
    {
        return $this->totalQuotes;
    }

    /**
     * @param int $totalQuotes
     */
    public function setTotalQuotes(int $totalQuotes): void
    {
        $this->totalQuotes = $totalQuotes;
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
        $data = [
            'collection' => $this->getCollections()
        ];

        if (isset($this->couriers)) {
            $data += [
                'couriers' => $this->getCouriers()
            ];
        }

        if ($this->courierCode) {
            $data += [
                'courier_code' => $this->getCourierCode()
            ];
        }

        if (isset($this->serviceType)) {
            $data += [
                'service_type' => $this->getServiceType()
            ];
        }

        if (isset($this->totalQuotes)) {
            $data += [
                'total_quotes' => $this->getTotalQuotes()
            ];
        }

        return $data;
    }
}
