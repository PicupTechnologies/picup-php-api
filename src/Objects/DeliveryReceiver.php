<?php

declare(strict_types=1);

namespace PicupTechnologies\PicupPHPApi\Objects;

use JsonSerializable;
use PicupTechnologies\PicupPHPApi\Collections\ParcelCollection;

/**
 * Class DeliveryReceiver
 *
 * @package PicupTechnologies\PicupPHPApi\Objects
 */
final class DeliveryReceiver implements JsonSerializable
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
     * @var ParcelCollection
     */
    private $parcels;

    /**
     * @var string
     */
    private $specialInstructions;

    /**
     * DeliveryReceiver constructor.
     *
     * @param DeliveryReceiverAddress $deliveryReceiverAddress
     * @param DeliveryReceiverContact $deliveryReceiverContact
     * @param ParcelCollection        $parcels
     * @param string                  $specialInstructions
     */
    public function __construct(DeliveryReceiverAddress $deliveryReceiverAddress, DeliveryReceiverContact $deliveryReceiverContact, ParcelCollection $parcels, string $specialInstructions = '')
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

    public function getParcels() : ParcelCollection
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
        $return = [
            'address' => $this->address,
            'contact' => $this->contact,
            'special_instructions' => $this->specialInstructions,
        ];

        if (isset($this->parcels) && !empty($this->parcels->getParcels())) {
            $parcelsToAdd = [];
            foreach ($this->parcels->getParcels() as $parcel) {
                $parcelsToAdd[] = [
                    'size' => $parcel->getId(),
                    'reference' => $parcel->getReference(),
                    'description' => $parcel->getDescription(),
                    'tracking_number' => $parcel->getTrackingNumber()
                ];
            }

            $return['parcels'] = $parcelsToAdd;
        }

        return $return;
    }
}
