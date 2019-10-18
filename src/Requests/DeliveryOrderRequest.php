<?php

declare(strict_types=1);


namespace PicupTechnologies\PicupPHPApi\Requests;

use DateTime;
use JsonSerializable;
use PicupTechnologies\PicupPHPApi\Contracts\PicupRequestInterface;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryReceiver;
use PicupTechnologies\PicupPHPApi\Objects\DeliverySender;

/**
 * Encapsulates a full order request for picup destined for the
 * Create/One-To-Many endpoint.
 *
 * The Create One-to-Many call will create a picup trip. The following
 * example takes a sender object and an array of receivers, with a
 * contact and address, and creates the picup as quoted for the
 * vehicle-id provided. A customer reference is also provided to help
 * with the tracking, as well as any communication provided.
 *
 * When successful you will be able to obtain the deliveryId by calling
 * $deliveryOrderResponse->getId()
 *
 * Once created, the picup's will be available for viewing at on picup
 * enterprise.
 *
 * This will also add the addresses created to the Geocoder module.
 *
 * @package PicupTechnologies\PicupPHPApi\Requests
 * @url     http://enterprise.codependent.digital/dashboard/post-dispatch
 */
class DeliveryOrderRequest implements PicupRequestInterface, JsonSerializable
{
    private $merchantId;
    private $customerRef;
    private $vehicleId;

    /**
     * @var bool
     */
    private $isForContractDriver = false;

    /**
     * @var bool
     */
    private $isRoundTrip = false;

    /**
     * @var DateTime
     */
    private $scheduledDate;

    /**
     * @var DeliverySender
     */
    private $sender;

    /**
     * @var DeliveryReceiver[]
     */
    private $receivers;

    public function getMerchantId()
    {
        return $this->merchantId;
    }

    public function setMerchantId($merchantId) : void
    {
        $this->merchantId = $merchantId;
    }

    public function getCustomerRef()
    {
        return $this->customerRef;
    }

    public function setCustomerRef($customerRef) : void
    {
        $this->customerRef = $customerRef;
    }

    public function getVehicleId()
    {
        return $this->vehicleId;
    }

    public function setVehicleId($vehicleId) : void
    {
        $this->vehicleId = $vehicleId;
    }

    public function isForContractDriver() : bool
    {
        return $this->isForContractDriver;
    }

    public function setIsForContractDriver(bool $isForContractDriver) : void
    {
        $this->isForContractDriver = $isForContractDriver;
    }

    public function isRoundTrip() : bool
    {
        return $this->isRoundTrip;
    }

    public function setIsRoundTrip(bool $isRoundTrip) : void
    {
        $this->isRoundTrip = $isRoundTrip;
    }

    public function getScheduledDate() : DateTime
    {
        return $this->scheduledDate;
    }

    public function setScheduledDate(DateTime $scheduledDate) : void
    {
        $this->scheduledDate = $scheduledDate;
    }

    public function getSender() : DeliverySender
    {
        return $this->sender;
    }

    public function setSender(DeliverySender $sender) : void
    {
        $this->sender = $sender;
    }

    /**
     * @return DeliveryReceiver[]
     */
    public function getReceivers() : array
    {
        return $this->receivers;
    }

    /**
     * @param DeliveryReceiver[] $receivers
     */
    public function setReceivers(array $receivers) : void
    {
        $this->receivers = $receivers;
    }

    /**
     * Specify data which should be serialized to JSON
     *
     * @see  http://php.net/manual/en/jsonserializable.jsonserialize.php
     *
     * @return mixed data which can be serialized by <b>json_encode</b>,
     *               which is a value of any type other than a resource
     *
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return [
            'merchant_id' => $this->merchantId,
            'customer_ref' => $this->customerRef,
            'vehicle_id' => $this->vehicleId,

            'is_for_contract_driver' => $this->isForContractDriver,
            'is_round_trip' => $this->isRoundTrip,

            'scheduled_date' => $this->scheduledDate->format('Y-m-d\TH:i:s.u\Z'),
            'sender' => $this->sender,
            'receivers' => $this->receivers,
        ];
    }
}
