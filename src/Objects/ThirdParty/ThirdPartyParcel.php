<?php

namespace PicupTechnologies\PicupPHPApi\Objects\ThirdParty;

use JsonSerializable;
use PicupTechnologies\PicupPHPApi\Objects\Parcel;

/**
 * Parcel with fields defined for ThirdParty parcels
 *
 * Yep - it's another parcel type with it's own set of fields.
 *
 * So we extend the current fields from Parcel and add the missing ones
 *
 * @package PicupTechnologies\PicupPHPApi\Objects\ThirdParty
 */
class ThirdPartyParcel extends Parcel implements JsonSerializable
{
    /**
     * @var ?float
     */
    private $mass;

    /**
     * @var ?string
     */
    private $status;

    /**
     * @return mixed
     */
    public function getMass()
    {
        return $this->mass;
    }

    /**
     * @param mixed $mass
     */
    public function setMass($mass): void
    {
        $this->mass = $mass;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
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
            'parcel_id' => $this->getId(),
            'tracking_number' => $this->getTrackingNumber(),
            'description' => $this->getDescription(),
            'mass' => $this->getMass(),
            'status' => $this->getStatus()
        ];

        if ($this->getDimensions()) {
            $data += [
                'length' => $this->getDimensions()->getLength(),
                'width' => $this->getDimensions()->getWidth(),
                'height' => $this->getDimensions()->getHeight(),
            ];
        }

        return $data;
    }
}
