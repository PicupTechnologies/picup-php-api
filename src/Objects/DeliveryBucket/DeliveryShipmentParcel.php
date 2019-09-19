<?php

namespace PicupTechnologies\PicupPHPApi\Objects\DeliveryBucket;

use JsonSerializable;

class DeliveryShipmentParcel implements JsonSerializable
{
    private $size;
    private $trackingNumber;
    private $parcelReference;
    private $description;

    /**
     * @return mixed
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param mixed $size
     */
    public function setSize($size): void
    {
        $this->size = $size;
    }

    /**
     * @return mixed
     */
    public function getTrackingNumber()
    {
        return $this->trackingNumber;
    }

    /**
     * @param mixed $trackingNumber
     */
    public function setTrackingNumber($trackingNumber): void
    {
        $this->trackingNumber = $trackingNumber;
    }

    /**
     * @return mixed
     */
    public function getParcelReference()
    {
        return $this->parcelReference;
    }

    /**
     * @param mixed $parcelReference
     */
    public function setParcelReference($parcelReference): void
    {
        $this->parcelReference = $parcelReference;
    }

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
            'size'             => $this->size,
            'tracking_number'  => $this->trackingNumber,
            'parcel_reference' => $this->parcelReference,
            'description'      => $this->description,
        ];
    }
}
