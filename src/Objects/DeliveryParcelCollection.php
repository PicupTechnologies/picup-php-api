<?php

declare(strict_types=1);


namespace PicupTechnologies\PicupPHPApi\Objects;

use JsonSerializable;

/**
 * Class DeliveryParcelCollection
 *
 * Stores a collection of DeliveryParcels for usage in a DeliveryOrderQuoteRequest
 */
class DeliveryParcelCollection implements JsonSerializable
{
    /**
     * @var DeliveryParcel[]
     */
    private $parcels;

    /**
     * Adds a parcel to the collection
     */
    public function addParcel(DeliveryParcel $parcel) : void
    {
        $this->parcels[] = $parcel;
    }

    /**
     * Returns an array of all current parcels
     *
     * @return array
     */
    public function getParcels() : ?array
    {
        return $this->parcels;
    }

    /**
     * Specify data which should be serialized to JSON
     *
     * @see  https://php.net/manual/en/jsonserializable.jsonserialize.php
     *
     * @return mixed data which can be serialized by <b>json_encode</b>,
     *               which is a value of any type other than a resource
     *
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return $this->parcels;
    }
}
