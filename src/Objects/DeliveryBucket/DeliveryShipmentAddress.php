<?php

declare(strict_types=1);

namespace PicupTechnologies\PicupPHPApi\Objects\DeliveryBucket;

use JsonSerializable;

/**
 * Class DeliveryShipmentAddress
 *
 * @package PicupTechnologies\PicupPHPApi\Objects\DeliveryBucket
 */
class DeliveryShipmentAddress implements JsonSerializable
{
    private $addressReference;

    private $addressLine1;
    private $addressLine2;
    private $addressLine3;
    private $addressLine4;
    private $formattedAddress;

    private $city;
    private $suburb;
    private $country;

    private $latitude;
    private $longitude;

    public function getAddressReference()
    {
        return $this->addressReference;
    }

    public function setAddressReference($addressReference) : void
    {
        $this->addressReference = $addressReference;
    }

    public function getAddressLine1()
    {
        return $this->addressLine1;
    }

    public function setAddressLine1($addressLine1) : void
    {
        $this->addressLine1 = $addressLine1;
    }

    public function getAddressLine2()
    {
        return $this->addressLine2;
    }

    public function setAddressLine2($addressLine2) : void
    {
        $this->addressLine2 = $addressLine2;
    }

    public function getAddressLine3()
    {
        return $this->addressLine3;
    }

    public function setAddressLine3($addressLine3) : void
    {
        $this->addressLine3 = $addressLine3;
    }

    public function getAddressLine4()
    {
        return $this->addressLine4;
    }

    public function setAddressLine4($addressLine4) : void
    {
        $this->addressLine4 = $addressLine4;
    }

    public function getFormattedAddress()
    {
        return $this->formattedAddress;
    }

    public function setFormattedAddress($formattedAddress) : void
    {
        $this->formattedAddress = $formattedAddress;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function setCity($city) : void
    {
        $this->city = $city;
    }

    public function getSuburb()
    {
        return $this->suburb;
    }

    public function setSuburb($suburb) : void
    {
        $this->suburb = $suburb;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function setCountry($country) : void
    {
        $this->country = $country;
    }

    public function getLatitude()
    {
        return $this->latitude;
    }

    public function setLatitude($latitude) : void
    {
        $this->latitude = $latitude;
    }

    public function getLongitude()
    {
        return $this->longitude;
    }

    public function setLongitude($longitude) : void
    {
        $this->longitude = $longitude;
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
            'address_reference' => $this->addressReference,

            'address_line_1' => $this->addressLine1,
            'address_line_2' => $this->addressLine2,
            'address_line_3' => $this->addressLine3,
            'address_line_4' => $this->addressLine4,

            'formatted_address' => $this->formattedAddress,

            'city' => $this->city,
            'suburb' => $this->suburb,
            'country' => $this->country,

            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
        ];
    }
}
