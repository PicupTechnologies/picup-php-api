<?php

namespace PicupTechnologies\PicupPHPApi\Requests;

use DateTime;
use JsonSerializable;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryReceiver;
use PicupTechnologies\PicupPHPApi\Objects\DeliverySender;

/**
 * Holds all the details for a DeliveryQuoteRequest
 *
 * @package PicupTechnologies\PicupPHPApi\Requests
 */
class DeliveryQuoteRequest implements JsonSerializable
{
    /**
     * Merchant UUID
     *
     * @var string
     */
    private $merchantId;

    /**
     * Customer Reference
     *
     * @var string
     */
    private $customerRef;

    private $isForContractDriver = false;

    private $userId = '';
    private $courierCosting = 'NONE';

    /**
     * Scheduled date
     *
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

    /**
     * @return string
     */
    public function getMerchantId(): string
    {
        return $this->merchantId;
    }

    /**
     * @param string $merchantId
     */
    public function setMerchantId(string $merchantId): void
    {
        $this->merchantId = $merchantId;
    }

    /**
     * @return string
     */
    public function getCustomerRef(): string
    {
        return $this->customerRef;
    }

    /**
     * @param string $customerRef
     */
    public function setCustomerRef(string $customerRef): void
    {
        $this->customerRef = $customerRef;
    }

    /**
     * @return bool
     */
    public function isForContractDriver(): bool
    {
        return $this->isForContractDriver;
    }

    /**
     * @param bool $isForContractDriver
     */
    public function setIsForContractDriver(bool $isForContractDriver): void
    {
        $this->isForContractDriver = $isForContractDriver;
    }

    /**
     * @return string
     */
    public function getUserId(): string
    {
        return $this->userId;
    }

    /**
     * @param string $userId
     */
    public function setUserId(string $userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @return string
     */
    public function getCourierCosting(): string
    {
        return $this->courierCosting;
    }

    /**
     * @param string $courierCosting
     */
    public function setCourierCosting(string $courierCosting): void
    {
        $this->courierCosting = $courierCosting;
    }

    /**
     * @return DateTime
     */
    public function getScheduledDate(): DateTime
    {
        return $this->scheduledDate;
    }

    /**
     * @param DateTime $scheduledDate
     */
    public function setScheduledDate(DateTime $scheduledDate): void
    {
        $this->scheduledDate = $scheduledDate;
    }

    /**
     * @return DeliverySender
     */
    public function getSender(): DeliverySender
    {
        return $this->sender;
    }

    /**
     * @param DeliverySender $sender
     */
    public function setSender(DeliverySender $sender): void
    {
        $this->sender = $sender;
    }

    /**
     * @return DeliveryReceiver[]
     */
    public function getReceivers(): array
    {
        return $this->receivers;
    }

    /**
     * @param DeliveryReceiver[] $receivers
     */
    public function setReceivers(array $receivers): void
    {
        $this->receivers = $receivers;
    }

    /**
     * @param DeliveryReceiver $receiver
     */
    public function addReceiver(DeliveryReceiver $receiver): void
    {
        $this->receivers[] = $receiver;
    }

    /**
     * Specify data which should be serialized to JSON
     *
     * @link  http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        $quote = [
            'merchant_id'                   => $this->merchantId,
            'user_id'                       => $this->userId,
            'customer_ref'                  => $this->customerRef,
            'is_for_contract_driver'        => $this->isForContractDriver,
            'scheduled_date'                => $this->scheduledDate->format('Y-m-d\TH:i:s.u\Z'),
            'courier_costing'               => $this->courierCosting,
            'sender'                        => $this->sender,
            'receivers'                     => $this->receivers,
        ];

        return $quote;
    }
}
