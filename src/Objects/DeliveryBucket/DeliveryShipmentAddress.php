<?php

namespace PicupTechnologies\PicupPHPApi\Objects\DeliveryBucket;

use JsonSerializable;

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

    /**
     * @return mixed
     */
    public function getAddressReference()
    {
        return $this->addressReference;
    }

    /**
     * @param mixed $addressReference
     */
    public function setAddressReference($addressReference): void
    {
        $this->addressReference = $addressReference;
    }

    /**
     * @return mixed
     */
    public function getAddressLine1()
    {
        return $this->addressLine1;
    }

    /**
     * @param mixed $addressLine1
     */
    public function setAddressLine1($addressLine1): void
    {
        $this->addressLine1 = $addressLine1;
    }

    /**
     * @return mixed
     */
    public function getAddressLine2()
    {
        return $this->addressLine2;
    }

    /**
     * @param mixed $addressLine2
     */
    public function setAddressLine2($addressLine2): void
    {
        $this->addressLine2 = $addressLine2;
    }

    /**
     * @return mixed
     */
    public function getAddressLine3()
    {
        return $this->addressLine3;
    }

    /**
     * @param mixed $addressLine3
     */
    public function setAddressLine3($addressLine3): void
    {
        $this->addressLine3 = $addressLine3;
    }

    /**
     * @return mixed
     */
    public function getAddressLine4()
    {
        return $this->addressLine4;
    }

    /**
     * @param mixed $addressLine4
     */
    public function setAddressLine4($addressLine4): void
    {
        $this->addressLine4 = $addressLine4;
    }

    /**
     * @return mixed
     */
    public function getFormattedAddress()
    {
        return $this->formattedAddress;
    }

    /**
     * @param mixed $formattedAddress
     */
    public function setFormattedAddress($formattedAddress): void
    {
        $this->formattedAddress = $formattedAddress;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city): void
    {
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getSuburb()
    {
        return $this->suburb;
    }

    /**
     * @param mixed $suburb
     */
    public function setSuburb($suburb): void
    {
        $this->suburb = $suburb;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param mixed $country
     */
    public function setCountry($country): void
    {
        $this->country = $country;
    }

    /**
     * @return mixed
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param mixed $latitude
     */
    public function setLatitude($latitude): void
    {
        $this->latitude = $latitude;
    }

    /**
     * @return mixed
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param mixed $longitude
     */
    public function setLongitude($longitude): void
    {
        $this->longitude = $longitude;
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
            'address_reference' => $this->addressReference,

            'address_line_1' => $this->addressLine1,
            'address_line_2' => $this->addressLine2,
            'address_line_3' => $this->addressLine3,
            'address_line_4' => $this->addressLine4,

            'formatted_address' => $this->formattedAddress,

            'city'    => $this->city,
            'suburb'  => $this->suburb,
            'country' => $this->country,

            'latitude'  => $this->latitude,
            'longitude' => $this->longitude,
        ];
    }
}
