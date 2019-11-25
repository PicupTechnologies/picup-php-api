<?php

namespace PicupTechnologies\PicupPHPApi\Objects\ThirdParty;

use JsonSerializable;
use PicupTechnologies\PicupPHPApi\Contracts\WaybillAddressInterface;

abstract class WaybillAddress implements WaybillAddressInterface, JsonSerializable
{
    /**
     * @var string
     */
    private $addressLine1;

    /**
     * @var ?string
     */
    private $addressLine2;

    /**
     * @var ?string
     */
    private $addressLine3;

    /**
     * @var ?string
     */
    private $addressLine4;

    /**
     * @var string
     */
    private $suburb;

    /**
     * @var string
     */
    private $postalCode;

    /**
     * @var float
     */
    private $latitude;

    /**
     * @var float
     */
    private $longitude;

    /**
     * @var string
     */
    private $customerName;

    /**
     * @var string
     */
    private $customerPhone;

    /**
     * @var string
     */
    private $customerEmail;

    /**
     * @var ?string
     */
    private $specialInstructions;

    /**
     * @return string
     */
    public function getAddressLine1(): string
    {
        return $this->addressLine1;
    }

    /**
     * @param string $addressLine1
     */
    public function setAddressLine1(string $addressLine1): void
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
     * @return string
     */
    public function getSuburb(): ?string
    {
        return $this->suburb;
    }

    /**
     * @param string $suburb
     */
    public function setSuburb(string $suburb): void
    {
        $this->suburb = $suburb;
    }

    /**
     * @return string
     */
    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    /**
     * @param string $postalCode
     */
    public function setPostalCode(string $postalCode): void
    {
        $this->postalCode = $postalCode;
    }

    /**
     * @return float
     */
    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    /**
     * @param float $latitude
     */
    public function setLatitude(float $latitude): void
    {
        $this->latitude = $latitude;
    }

    /**
     * @return float
     */
    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    /**
     * @param float $longitude
     */
    public function setLongitude(float $longitude): void
    {
        $this->longitude = $longitude;
    }

    /**
     * @return string
     */
    public function getCustomerName(): string
    {
        return $this->customerName;
    }

    /**
     * @param string $customerName
     */
    public function setCustomerName(string $customerName): void
    {
        $this->customerName = $customerName;
    }

    /**
     * @return string
     */
    public function getCustomerPhone(): string
    {
        return $this->customerPhone;
    }

    /**
     * @param string $customerPhone
     */
    public function setCustomerPhone(string $customerPhone): void
    {
        $this->customerPhone = $customerPhone;
    }

    /**
     * @return string
     */
    public function getCustomerEmail(): string
    {
        return $this->customerEmail;
    }

    /**
     * @param string $customerEmail
     */
    public function setCustomerEmail(string $customerEmail): void
    {
        $this->customerEmail = $customerEmail;
    }

    /**
     * @return mixed
     */
    public function getSpecialInstructions()
    {
        return $this->specialInstructions;
    }

    /**
     * @param mixed $specialInstructions
     */
    public function setSpecialInstructions($specialInstructions): void
    {
        $this->specialInstructions = $specialInstructions;
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
            'address_line_1' => $this->getAddressLine1(),
            'address_line_2' => $this->getAddressLine2(),
            'address_line_3' => $this->getAddressLine3(),
            'address_line_4' => $this->getAddressLine4(),
            'suburb' => $this->getSuburb(),
            'postal_code' => $this->getPostalCode(),
            'latitude' => $this->getLatitude(),
            'longitude' => $this->getLongitude(),
            'customer_name' => $this->getCustomerName(),
            'customer_phone' => $this->getCustomerPhone(),
            'customer_email' => $this->getCustomerEmail(),
            'special_instructions' => $this->getSpecialInstructions()
        ];
    }
}
