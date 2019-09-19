<?php

namespace PicupTechnologies\PicupPHPApi\Objects\DeliveryBucket;

use JsonSerializable;

class DeliveryShipment implements JsonSerializable
{
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

    /**
     * @var DeliveryShipmentParcel[]
     */
    public $parcels;

    /**
     * @return string
     */
    public function getConsignment(): string
    {
        return $this->consignment;
    }

    /**
     * @param string $consignment
     */
    public function setConsignment(string $consignment): void
    {
        $this->consignment = $consignment;
    }

    /**
     * @return string
     */
    public function getBusinessReference(): string
    {
        return $this->businessReference;
    }

    /**
     * @param string $businessReference
     */
    public function setBusinessReference(string $businessReference): void
    {
        $this->businessReference = $businessReference;
    }

    /**
     * @return DeliveryShipmentAddress
     */
    public function getAddress(): DeliveryShipmentAddress
    {
        return $this->address;
    }

    /**
     * @param DeliveryShipmentAddress $address
     */
    public function setAddress(DeliveryShipmentAddress $address): void
    {
        $this->address = $address;
    }

    /**
     * @return DeliveryShipmentContact
     */
    public function getContact(): DeliveryShipmentContact
    {
        return $this->contact;
    }

    /**
     * @param DeliveryShipmentContact $contact
     */
    public function setContact(DeliveryShipmentContact $contact): void
    {
        $this->contact = $contact;
    }

    /**
     * @return DeliveryShipmentParcel[]
     */
    public function getParcels(): array
    {
        return $this->parcels;
    }

    /**
     * @param DeliveryShipmentParcel[] $parcels
     */
    public function setParcels(array $parcels): void
    {
        $this->parcels = $parcels;
    }

    /**
     * Add a parcel to the collection
     *
     * @param DeliveryShipmentParcel $parcel
     */
    public function addParcel(DeliveryShipmentParcel $parcel): void
    {
        $this->parcels[] = $parcel;
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
            'consignment'        => $this->consignment,
            'business_reference' => $this->businessReference,

            'address' => $this->address,
            'contact' => $this->contact,
            'parcels' => $this->parcels,
        ];
    }
}
