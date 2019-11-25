<?php

namespace PicupTechnologies\PicupPHPApi\Contracts;

interface WaybillAddressInterface
{
    /**
     * @return string
     */
    public function getAddressLine1(): string;

    /**
     * @param string $addressLine1
     */
    public function setAddressLine1(string $addressLine1): void;

    /**
     * @return mixed
     */
    public function getAddressLine2();

    /**
     * @param mixed $addressLine2
     */
    public function setAddressLine2($addressLine2): void;

    /**
     * @return mixed
     */
    public function getAddressLine3();

    /**
     * @param mixed $addressLine3
     */
    public function setAddressLine3($addressLine3): void;

    /**
     * @return mixed
     */
    public function getAddressLine4();

    /**
     * @param mixed $addressLine4
     */
    public function setAddressLine4($addressLine4): void;

    /**
     * @return string
     */
    public function getSuburb(): ?string;

    /**
     * @param string $suburb
     */
    public function setSuburb(string $suburb): void;

    /**
     * @return string
     */
    public function getPostalCode(): ?string;

    /**
     * @param string $postalCode
     */
    public function setPostalCode(string $postalCode): void;

    /**
     * @return float
     */
    public function getLatitude(): ?float;

    /**
     * @param float $latitude
     */
    public function setLatitude(float $latitude): void;

    /**
     * @return float
     */
    public function getLongitude(): ?float;

    /**
     * @param float $longitude
     */
    public function setLongitude(float $longitude): void;

    /**
     * @return string
     */
    public function getCustomerName(): string;

    /**
     * @param string $customerName
     */
    public function setCustomerName(string $customerName): void;

    /**
     * @return string
     */
    public function getCustomerPhone(): string;

    /**
     * @param string $customerPhone
     */
    public function setCustomerPhone(string $customerPhone): void;

    /**
     * @return string
     */
    public function getCustomerEmail(): string;

    /**
     * @param string $customerEmail
     */
    public function setCustomerEmail(string $customerEmail): void;

    /**
     * @return mixed
     */
    public function getSpecialInstructions();

    /**
     * @param mixed $specialInstructions
     */
    public function setSpecialInstructions($specialInstructions): void;
}
