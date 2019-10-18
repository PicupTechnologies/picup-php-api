<?php

declare(strict_types=1);

namespace PicupTechnologies\PicupPHPApi\Objects;

/**
 * Class DeliveryReceiverAddress
 *
 * @package PicupTechnologies\PicupPHPApi\Objects
 */
abstract class DeliveryAddress
{
    /**
     * @var string
     */
    private $unitNo;

    /**
     * @var string
     */
    private $complex;

    /**
     * @var string
     */
    private $streetOrFarmNo;

    /**
     * @var string
     */
    private $streetOrFarm;

    /**
     * @var string
     */
    private $suburb;

    /**
     * @var string
     */
    private $city;

    /**
     * @var string
     */
    private $postalCode;

    /**
     * @var string
     */
    private $country;

    /**
     * @var float
     */
    private $latitude;

    /**
     * @var float
     */
    private $longitude;

    /**
     * @return string
     */
    public function getUnitNo() : ?string
    {
        return $this->unitNo;
    }

    public function setUnitNo(string $unitNo) : void
    {
        $this->unitNo = $unitNo;
    }

    /**
     * @return string
     */
    public function getComplex() : ?string
    {
        return $this->complex;
    }

    public function setComplex(string $complex) : void
    {
        $this->complex = $complex;
    }

    /**
     * @return string
     */
    public function getStreetOrFarmNo() : ?string
    {
        return $this->streetOrFarmNo;
    }

    public function setStreetOrFarmNo(string $streetOrFarmNo) : void
    {
        $this->streetOrFarmNo = $streetOrFarmNo;
    }

    /**
     * @return string
     */
    public function getStreetOrFarm() : ?string
    {
        return $this->streetOrFarm;
    }

    public function setStreetOrFarm(string $streetOrFarm) : void
    {
        $this->streetOrFarm = $streetOrFarm;
    }

    /**
     * @return string
     */
    public function getSuburb() : ?string
    {
        return $this->suburb;
    }

    public function setSuburb(string $suburb) : void
    {
        $this->suburb = $suburb;
    }

    /**
     * @return string
     */
    public function getCity() : ?string
    {
        return $this->city;
    }

    public function setCity(string $city) : void
    {
        $this->city = $city;
    }

    /**
     * @return string
     */
    public function getPostalCode() : ?string
    {
        return $this->postalCode;
    }

    public function setPostalCode(string $postalCode) : void
    {
        $this->postalCode = $postalCode;
    }

    /**
     * @return string
     */
    public function getCountry() : ?string
    {
        return $this->country;
    }

    public function setCountry(string $country) : void
    {
        $this->country = $country;
    }

    /**
     * @return float
     */
    public function getLatitude() : ?float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude) : void
    {
        $this->latitude = $latitude;
    }

    /**
     * @return float
     */
    public function getLongitude() : ?float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude) : void
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
            'unit_no' => $this->unitNo,
            'complex' => $this->complex,
            'street_or_farm_no' => $this->streetOrFarmNo,
            'street_or_farm' => $this->streetOrFarm,
            'suburb' => $this->suburb,
            'city' => $this->city,
            'postal_code' => $this->postalCode,
            'country' => $this->country,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
        ];
    }
}
