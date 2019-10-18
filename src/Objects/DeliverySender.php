<?php

declare(strict_types=1);

namespace PicupTechnologies\PicupPHPApi\Objects;

use JsonSerializable;

/**
 * Class DeliverySender
 */
final class DeliverySender implements JsonSerializable
{
    /**
     * @var DeliverySenderAddress
     */
    private $address;

    /**
     * @var DeliveryContact
     */
    private $contact;

    /**
     * Special instructors to the sender
     *
     * @var string
     */
    private $specialInstructions;

    /**
     * DeliverySender constructor.
     *
     * @param DeliverySenderAddress $address
     * @param DeliveryContact       $contact
     * @param string                $specialInstructions
     */
    public function __construct(DeliverySenderAddress $address, DeliveryContact $contact, string $specialInstructions = '')
    {
        $this->address = $address;
        $this->contact = $contact;
        $this->specialInstructions = $specialInstructions;
    }

    public function getAddress() : DeliverySenderAddress
    {
        return $this->address;
    }

    public function getContact() : DeliveryContact
    {
        return $this->contact;
    }

    public function getSpecialInstructions() : string
    {
        return $this->specialInstructions;
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
            'address' => $this->address,
            'contact' => $this->contact,
            'special_instructions' => $this->specialInstructions
        ];
    }
}
