<?php

declare(strict_types=1);

namespace PicupTechnologies\PicupPHPApi\Objects\DeliveryBucket;

use JsonSerializable;

class DeliveryShipment implements JsonSerializable
{
    /**
     * @var DeliveryShipmentParcel[]
     */
    public $parcels;
    /**
     * @var string
     */
    private $consignment;

    /**
     * @var string
     */
    private $businessReference;

    /**
     * @var DeliveryShipmentAddress
     */
    private $address;

    /**
     * @var DeliveryShipmentContact
     */
    private $contact;

    public function getConsignment() : string
    {
        return $this->consignment;
    }

    public function setConsignment(string $consignment) : void
    {
        $this->consignment = $consignment;
    }

    public function getBusinessReference() : string
    {
        return $this->businessReference;
    }

    public function setBusinessReference(string $businessReference) : void
    {
        $this->businessReference = $businessReference;
    }

    public function getAddress() : DeliveryShipmentAddress
    {
        return $this->address;
    }

    public function setAddress(DeliveryShipmentAddress $address) : void
    {
        $this->address = $address;
    }

    public function getContact() : DeliveryShipmentContact
    {
        return $this->contact;
    }

    public function setContact(DeliveryShipmentContact $contact) : void
    {
        $this->contact = $contact;
    }

    /**
     * @return DeliveryShipmentParcel[]
     */
    public function getParcels() : array
    {
        return $this->parcels;
    }

    /**
     * @param DeliveryShipmentParcel[] $parcels
     */
    public function setParcels(array $parcels) : void
    {
        $this->parcels = $parcels;
    }

    /**
     * Add a parcel to the collection
     */
    public function addParcel(DeliveryShipmentParcel $parcel) : void
    {
        $this->parcels[] = $parcel;
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
            'consignment' => $this->consignment,
            'business_reference' => $this->businessReference,

            'address' => $this->address,
            'contact' => $this->contact,
            'parcels' => $this->parcels,
        ];
    }
}
