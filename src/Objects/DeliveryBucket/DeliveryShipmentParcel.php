<?php

declare(strict_types=1);

namespace PicupTechnologies\PicupPHPApi\Objects\DeliveryBucket;

use JsonSerializable;

class DeliveryShipmentParcel implements JsonSerializable
{
    private $size;
    private $trackingNumber;
    private $parcelReference;
    private $description;

    public function getSize()
    {
        return $this->size;
    }

    public function setSize($size) : void
    {
        $this->size = $size;
    }

    public function getTrackingNumber()
    {
        return $this->trackingNumber;
    }

    public function setTrackingNumber($trackingNumber) : void
    {
        $this->trackingNumber = $trackingNumber;
    }

    public function getParcelReference()
    {
        return $this->parcelReference;
    }

    public function setParcelReference($parcelReference) : void
    {
        $this->parcelReference = $parcelReference;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description) : void
    {
        $this->description = $description;
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
        return [
            'size' => $this->size,
            'tracking_number' => $this->trackingNumber,
            'parcel_reference' => $this->parcelReference,
            'description' => $this->description,
        ];
    }
}
