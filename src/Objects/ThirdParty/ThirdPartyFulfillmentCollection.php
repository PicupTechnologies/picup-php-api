<?php

namespace PicupTechnologies\PicupPHPApi\Objects\ThirdParty;

use DateTime;
use JsonSerializable;

/**
 * Class FulfillmentCollection
 *
 * @package PicupTechnologies\PicupPHPApi\Objects\ThirdParty
 */
final class ThirdPartyFulfillmentCollection implements JsonSerializable
{
    /**
     * @var ?string
     */
    private $bucketId;

    /**
     * @var DateTime
     */
    private $collectionDate;

    /**
     * @var DateTime
     */
    private $collectionStartTime;

    /**
     * @var DateTime
     */
    private $collectionEndTime;

    /**
     * @var DateTime
     */
    private $deliveryDate;

    /**
     * @var string
     */
    private $collectionReference;

    /**
     * @var string
     */
    private $businessId;

    /**
     * @var string
     */
    private $userId;

    /**
     * @var ?string
     */
    private $warehouseId;

    /**
     * @var ThirdPartyWaybill
     */

    private $waybill;

    /**
     * @return string
     */
    public function getBucketId(): ?string
    {
        return $this->bucketId;
    }

    /**
     * @param string $bucketId
     */
    public function setBucketId(?string $bucketId): void
    {
        $this->bucketId = $bucketId;
    }

    /**
     * @return DateTime
     */
    public function getCollectionDate(): DateTime
    {
        return $this->collectionDate;
    }

    /**
     * @param DateTime $collectionDate
     */
    public function setCollectionDate(DateTime $collectionDate): void
    {
        $this->collectionDate = $collectionDate;
    }

    /**
     * @return DateTime
     */
    public function getCollectionStartTime(): DateTime
    {
        return $this->collectionStartTime;
    }

    /**
     * @param DateTime $collectionStartTime
     */
    public function setCollectionStartTime(DateTime $collectionStartTime): void
    {
        $this->collectionStartTime = $collectionStartTime;
    }

    /**
     * @return DateTime
     */
    public function getCollectionEndTime(): DateTime
    {
        return $this->collectionEndTime;
    }

    /**
     * @param DateTime $collectionEndTime
     */
    public function setCollectionEndTime(DateTime $collectionEndTime): void
    {
        $this->collectionEndTime = $collectionEndTime;
    }

    /**
     * @return DateTime
     */
    public function getDeliveryDate(): DateTime
    {
        return $this->deliveryDate;
    }

    /**
     * @param DateTime $deliveryDate
     */
    public function setDeliveryDate(DateTime $deliveryDate): void
    {
        $this->deliveryDate = $deliveryDate;
    }

    /**
     * @return string
     */
    public function getCollectionReference(): string
    {
        return $this->collectionReference;
    }

    /**
     * @param string $collectionReference
     */
    public function setCollectionReference(string $collectionReference): void
    {
        $this->collectionReference = $collectionReference;
    }

    /**
     * @return string
     */
    public function getBusinessId(): string
    {
        return $this->businessId;
    }

    /**
     * @param string $businessId
     */
    public function setBusinessId(string $businessId): void
    {
        $this->businessId = $businessId;
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
    public function getWarehouseId(): ?string
    {
        return $this->warehouseId;
    }

    /**
     * @param string $warehouseId
     */
    public function setWarehouseId(?string $warehouseId): void
    {
        $this->warehouseId = $warehouseId;
    }

    /**
     * @return ThirdPartyWaybill
     */
    public function getWaybill(): ThirdPartyWaybill
    {
        return $this->waybill;
    }

    /**
     * @param ThirdPartyWaybill $waybill
     */
    public function setWaybill(ThirdPartyWaybill $waybill): void
    {
        $this->waybill = $waybill;
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
            'bucket_id' => $this->getBucketId(),
            'collection_date' => $this->getCollectionDate()->format('Y-m-d\TH:i:s\Z'),
            'collection_start_time' => $this->getCollectionStartTime()->format('H:i:s'),
            'collection_end_time' => $this->getCollectionEndTime()->format('H:i:s'),
            'delivery_date' => $this->getDeliveryDate()->format('Y-m-d\TH:i:s\Z'),
            'collection_reference' => $this->getCollectionReference(),
            'business_id' => $this->getBusinessId(),
            'user_id' => $this->getUserId(),
            'warehouse_id' => $this->getWarehouseId(),
            'waybill' => $this->getWaybill()
        ];
    }
}
