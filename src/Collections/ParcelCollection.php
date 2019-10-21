<?php

declare(strict_types=1);

namespace PicupTechnologies\PicupPHPApi\Collections;

use JsonSerializable;
use PicupTechnologies\PicupPHPApi\Objects\Parcel;

/**
 * Class ParcelCollection
 *
 * Stores a collection of Parcels
 *
 * @package PicupTechnologies\PicupPHPApi\Objects
 */
final class ParcelCollection implements JsonSerializable
{
    /**
     * @var Parcel[]
     */
    private $parcels;

    /**
     * Adds a parcel to the collection
     *
     * @param Parcel $parcel
     */
    public function addParcel(Parcel $parcel) : void
    {
        $this->parcels[] = $parcel;
    }

    /**
     * Returns an array of all current parcels
     *
     * @return Parcel[]
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
