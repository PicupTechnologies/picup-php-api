<?php

namespace PicupTechnologies\PicupPHPApi\Objects\DeliveryBucket;

use InvalidArgumentException;
use JsonSerializable;

class DeliveryShipmentContact implements JsonSerializable
{
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
    private $emailAddress;

    /**
     * @var string
     */
    private $specialInstructions;

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
        $this->customerName = trim($customerName);
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
    public function setCustomerPhone($customerPhone): void
    {
        $this->customerPhone = $customerPhone;
    }

    /**
     * @return string
     */
    public function getEmailAddress(): string
    {
        return $this->emailAddress;
    }

    /**
     * @param string $emailAddress
     */
    public function setEmailAddress(string $emailAddress): void
    {
        if (!filter_var($emailAddress, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException(
                sprintf('%s expects valid email address, %s is not', __METHOD__, $emailAddress)
            );
        }

        $this->emailAddress = $emailAddress;
    }

    /**
     * @return string
     */
    public function getSpecialInstructions(): string
    {
        return $this->specialInstructions;
    }

    /**
     * @param string $specialInstructions
     */
    public function setSpecialInstructions(string $specialInstructions): void
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
            'customer_name'        => $this->customerName,
            'customer_phone'       => $this->customerPhone,
            'email_address'        => $this->emailAddress,
            'special_instructions' => $this->specialInstructions,
        ];
    }
}
