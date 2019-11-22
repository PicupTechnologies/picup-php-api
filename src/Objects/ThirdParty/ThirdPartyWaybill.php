<?php

namespace PicupTechnologies\PicupPHPApi\Objects\ThirdParty;

use JsonSerializable;

final class ThirdPartyWaybill implements JsonSerializable
{
    /**
     * @var ?string
     */
    private $orderId;

    /**
     * @var string
     */
    private $waybillNumber;

    /**
     * @var string
     */
    private $courierOrderId;

    /**
     * @var string
     */
    private $customerReference;

    /**
     * @var string
     */
    private $businessReference;

    /**
     * @var ?string
     */
    private $courierCode;

    /**
     * @var ?string
     */
    private $courierServiceType;

    /**
     * @var ?string
     */
    private $serviceType;

    /**
     * @var ?string
     */
    private $price;

    /**
     * @var ?string
     */
    private $reconciledPrice;

    /**
     * @var WaybillOrigin
     */
    private $origin;

    /**
     * @var WaybillDestination
     */
    private $destination;

    /**
     * @var ThirdPartyParcel[]
     */
    private $parcels;

    /**
     * @return mixed
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * @param mixed $orderId
     */
    public function setOrderId($orderId): void
    {
        $this->orderId = $orderId;
    }

    /**
     * @return mixed
     */
    public function getWaybillNumber()
    {
        return $this->waybillNumber;
    }

    /**
     * @param mixed $waybillNumber
     */
    public function setWaybillNumber($waybillNumber): void
    {
        $this->waybillNumber = $waybillNumber;
    }

    /**
     * @return mixed
     */
    public function getCourierOrderId()
    {
        return $this->courierOrderId;
    }

    /**
     * @param mixed $courierOrderId
     */
    public function setCourierOrderId($courierOrderId): void
    {
        $this->courierOrderId = $courierOrderId;
    }

    /**
     * @return mixed
     */
    public function getCustomerReference()
    {
        return $this->customerReference;
    }

    /**
     * @param mixed $customerReference
     */
    public function setCustomerReference($customerReference): void
    {
        $this->customerReference = $customerReference;
    }

    /**
     * @return mixed
     */
    public function getBusinessReference()
    {
        return $this->businessReference;
    }

    /**
     * @param mixed $businessReference
     */
    public function setBusinessReference($businessReference): void
    {
        $this->businessReference = $businessReference;
    }

    /**
     * @return mixed
     */
    public function getCourierCode()
    {
        return $this->courierCode;
    }

    /**
     * @param mixed $courierCode
     */
    public function setCourierCode($courierCode): void
    {
        $this->courierCode = $courierCode;
    }

    /**
     * @return mixed
     */
    public function getCourierServiceType()
    {
        return $this->courierServiceType;
    }

    /**
     * @param mixed $courierServiceType
     */
    public function setCourierServiceType($courierServiceType): void
    {
        $this->courierServiceType = $courierServiceType;
    }

    /**
     * @return mixed
     */
    public function getServiceType()
    {
        return $this->serviceType;
    }

    /**
     * @param mixed $serviceType
     */
    public function setServiceType($serviceType): void
    {
        $this->serviceType = $serviceType;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price): void
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getReconciledPrice()
    {
        return $this->reconciledPrice;
    }

    /**
     * @param mixed $reconciledPrice
     */
    public function setReconciledPrice($reconciledPrice): void
    {
        $this->reconciledPrice = $reconciledPrice;
    }

    /**
     * @return WaybillOrigin
     */
    public function getOrigin(): WaybillOrigin
    {
        return $this->origin;
    }

    /**
     * @param WaybillOrigin $origin
     */
    public function setOrigin(WaybillOrigin $origin): void
    {
        $this->origin = $origin;
    }

    /**
     * @return WaybillDestination
     */
    public function getDestination(): WaybillDestination
    {
        return $this->destination;
    }

    /**
     * @param WaybillDestination $destination
     */
    public function setDestination(WaybillDestination $destination): void
    {
        $this->destination = $destination;
    }

    /**
     * @return ThirdPartyParcel[]
     */
    public function getParcels(): array
    {
        return $this->parcels;
    }

    /**
     * @param ThirdPartyParcel $parcel
     */
    public function addParcel(ThirdPartyParcel $parcel): void
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
            'order_id' => $this->getOrderId(),
            'waybill_number' => $this->getWaybillNumber(),
            'courier_order_id' => $this->getCourierOrderId(),
            'customer_reference' => $this->getCustomerReference(),
            'business_reference' => $this->getBusinessReference(),
            'courier_code' => $this->getCourierCode(),
            'courier_service_type' => $this->getCourierServiceType(),
            'service_type' => $this->getServiceType(),
            'price' => $this->getPrice(),
            'reconciled_price' => $this->getReconciledPrice(),
            'origin' => $this->getOrigin(),
            'destination' => $this->getDestination(),
            'parcels' => $this->getParcels()
        ];
    }
}
