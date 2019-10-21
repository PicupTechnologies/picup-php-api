<?php

declare(strict_types=1);

namespace PicupTechnologies\PicupPHPApi\Objects\DeliveryBucket;

use JsonSerializable;
use PicupTechnologies\PicupPHPApi\Collections\ParcelCollection;
use PicupTechnologies\PicupPHPApi\Objects\Parcel;

/**
 * Class DeliveryShipment
 *
 * @package PicupTechnologies\PicupPHPApi\Objects\DeliveryBucket
 */
class DeliveryShipment implements JsonSerializable
{
    /**
     * @var ParcelCollection
     */
    private $parcels;

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
     * DeliveryShipment constructor.
     */
    public function __construct()
    {
        $this->parcels = new ParcelCollection();
    }

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

    public function getParcelCollection() : ParcelCollection
    {
        return $this->parcels;
    }

    public function setParcelCollection(ParcelCollection $parcels): void
    {
        $this->parcels = $parcels;
    }

    public function addParcel(Parcel $parcel): void
    {
        $this->parcels->addParcel($parcel);
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
        $return = [
            'consignment' => $this->consignment,
            'business_reference' => $this->businessReference,

            'address' => $this->address,
            'contact' => $this->contact
        ];

        // Alright - so we have different field names depending on which endpoints
        // we use. AddToBucket uses a totally different format to all the others.

        if (isset($this->parcels) && !empty($this->parcels->getParcels())) {
            $parcelsToAdd = [];
            foreach ($this->parcels->getParcels() as $parcel) {
                $parcelsToAdd[] = [
                    'size' => $parcel->getId(),
                    'parcel_reference' => $parcel->getReference(),
                    'description' => $parcel->getDescription(),
                    'tracking_number ' => $parcel->getTrackingNumber()
                ];
            }

            $return['parcels'] = $parcelsToAdd;
        }

        return $return;
    }
}
