<?php

namespace PicupTechnologies\PicupPHPApi\Objects\ThirdParty;

use DateTime;
use JsonSerializable;
use PicupTechnologies\PicupPHPApi\Collections\ThirdPartyCollection;

/**
 * Class FulfillmentOption
 *
 * @package PicupTechnologies\PicupPHPApi\Objects\ThirdParty
 */
final class ThirdPartyFulfillmentOption implements JsonSerializable
{
    /**
     * @var string
     */
    private $description;

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
     * @var ThirdPartyCollectionCollection
     */
    private $collections;

    /**
     * @var FulfillmentBreakdown[]
     */
    private $fulfillmentBreakdown;

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getPriceIncVat()
    {
        return $this->priceIncVat;
    }

    /**
     * @param mixed $priceIncVat
     */
    public function setPriceIncVat($priceIncVat): void
    {
        $this->priceIncVat = $priceIncVat;
    }

    /**
     * @return mixed
     */
    public function getPriceExVat()
    {
        return $this->priceExVat;
    }

    /**
     * @param mixed $priceExVat
     */
    public function setPriceExVat($priceExVat): void
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
     * @param mixed $collectedBefore
     */
    public function setCollectedBefore($collectedBefore): void
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
     * @param mixed $deliveredBefore
     */
    public function setDeliveredBefore($deliveredBefore): void
    {
        $this->deliveredBefore = $deliveredBefore;
    }

    /**
     * @return ThirdPartyCollectionCollection
     */
    public function getCollections(): ?ThirdPartyCollectionCollection
    {
        return $this->collections;
    }

    /**
     * @param ThirdPartyCollectionCollection $collections
     */
    public function setCollections(ThirdPartyCollectionCollection $collections): void
    {
        $this->collections = $collections;
    }

    /**
     * @return FulfillmentBreakdown[]
     */
    public function getFulfillmentBreakdown(): array
    {
        return $this->fulfillmentBreakdown;
    }

    /**
     * @param FulfillmentBreakdown $fulfillmentBreakdown
     */
    public function addFulfillmentBreakdown(FulfillmentBreakdown $fulfillmentBreakdown): void
    {
        $this->fulfillmentBreakdown[] = $fulfillmentBreakdown;
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
            'description' => $this->getDescription(),
            'price_incl_vat' => $this->getPriceIncVat(),
            'price_ex_vat' => $this->getPriceExVat(),
            'collected_before' => $this->getCollectedBefore()->format('Y-m-d\TH:i:s\Z'),
            'delivered_before' => $this->getDeliveredBefore()->format('Y-m-d\TH:i:s\Z'),
        ];

        if ($this->getCollections()) {
            $collections = $this->getCollections();
            $data += [
                'collections' => $collections,
            ];
        }

        if (isset($this->fulfillmentBreakdown)) {
            $data += [
                'fullfillment_breakdown' => $this->getFulfillmentBreakdown()
            ];
        }

        return $data;
    }
}
