<?php

declare(strict_types=1);


namespace PicupTechnologies\PicupPHPApi\Objects;

use JsonSerializable;
use PicupTechnologies\PicupPHPApi\Contracts\DeliveryParty;

/**
 * Class DeliveryReceiver
 */
class DeliveryReceiver implements DeliveryParty, JsonSerializable
{
    /**
     * @var DeliveryReceiverAddress
     */
    private $address;

    /**
     * @var DeliveryReceiverContact
     */
    private $contact;

    /**
     * @var DeliveryParcelCollection
     */
    private $parcels;

    /**
     * @var string
     */
    private $specialInstructions;

    /**
     * DeliveryReceiver constructor.
     */
    public function __construct(DeliveryReceiverAddress $deliveryReceiverAddress, DeliveryReceiverContact $deliveryReceiverContact, DeliveryParcelCollection $parcels, string $specialInstructions = '')
    {
        $this->address = $deliveryReceiverAddress;
        $this->contact = $deliveryReceiverContact;
        $this->parcels = $parcels;
        $this->specialInstructions = $specialInstructions;
    }

    public function getAddress() : DeliveryReceiverAddress
    {
        return $this->address;
    }

    public function getContact() : DeliveryReceiverContact
    {
        return $this->contact;
    }

    public function getParcels() : DeliveryParcelCollection
    {
        return $this->parcels;
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
            'parcels' => $this->parcels->getParcels(),
            'special_instructions' => $this->specialInstructions,
        ];
    }
}
