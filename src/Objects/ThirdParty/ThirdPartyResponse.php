<?php

namespace PicupTechnologies\PicupPHPApi\Objects\ThirdParty;

use JsonSerializable;

/**
 * Holds the third party courier response in a DeliveryQuoteResponse
 *
 * @package PicupTechnologies\PicupPHPApi\Objects\ThirdParty
 */
final class ThirdPartyResponse implements JsonSerializable
{
    /**
     * @var bool
     */
    private $valid;

    /**
     * @var ?string
     */
    private $error;

    /**
     * @var ThirdPartyFulfillmentOption[]
     */
    private $fulfillmentOptions;

    /**
     * @var ThirdPartyCollectionCollection
     */
    private $allCollectionPrices;

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
    public function getError(): ?string
    {
        return $this->error;
    }

    /**
     * @param string $error
     */
    public function setError(?string $error): void
    {
        $this->error = $error;
    }

    /**
     * @return ThirdPartyFulfillmentOption[]
     */
    public function getFulfillmentOptions(): array
    {
        return $this->fulfillmentOptions;
    }

    /**
     * @param ThirdPartyFulfillmentOption[] $fulfillmentOptions
     */
    public function setFulfillmentOptions(array $fulfillmentOptions): void
    {
        $this->fulfillmentOptions = $fulfillmentOptions;
    }

    /**
     * @param ThirdPartyFulfillmentOption $thirdPartyFulfillmentOption
     */
    public function addFulfillmentOption(ThirdPartyFulfillmentOption $thirdPartyFulfillmentOption): void
    {
        $this->fulfillmentOptions[] = $thirdPartyFulfillmentOption;
    }

    /**
     * @return ThirdPartyCollectionCollection
     */
    public function getAllCollectionPrices(): ThirdPartyCollectionCollection
    {
        return $this->allCollectionPrices;
    }

    /**
     * @param ThirdPartyCollectionCollection $allCollectionPrices
     */
    public function setAllCollectionPrices(ThirdPartyCollectionCollection $allCollectionPrices): void
    {
        $this->allCollectionPrices = $allCollectionPrices;
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
            'valid' => $this->isValid(),
            'error' => $this->getError(),
            'fullfillment_options' => $this->getFulfillmentOptions()
        ];

        if (isset($this->allCollectionPrices)) {
            $collectionPrices = $this->getAllCollectionPrices();

            $data += [
                'all_collection_prices' => $this->getAllCollectionPrices()->getCollections(),
                'couriers' => $this->getAllCollectionPrices()->getCouriers(),
                'total_quotes' => $this->getAllCollectionPrices()->getTotalQuotes(),
            ];

            if ($collectionPrices->getCourierCode()) {
                $data += [
                    'courier_code' => $collectionPrices->getCourierCode()
                ];
            }
        }

        return $data;
    }
}
