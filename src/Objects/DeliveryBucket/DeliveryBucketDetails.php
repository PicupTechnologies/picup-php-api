<?php

declare(strict_types=1);

namespace PicupTechnologies\PicupPHPApi\Objects\DeliveryBucket;

use DateTime;
use JsonSerializable;

/**
 * Class DeliveryBucketDetails
 *
 * @package PicupTechnologies\PicupPHPApi\Objects\DeliveryBucket
 */
class DeliveryBucketDetails implements JsonSerializable
{
    /**
     * @var DateTime
     */
    private $deliveryDate;

    /**
     * @var DateTime
     */
    private $shiftStart;

    /**
     * @var DateTime
     */
    private $shiftEnd;

    /**
     * @var string
     */
    private $warehouseId;

    /**
     * @var string
     */
    private $warehouseName;

    public function getDeliveryDate() : DateTime
    {
        return $this->deliveryDate;
    }

    public function setDeliveryDate(DateTime $deliveryDate) : void
    {
        $this->deliveryDate = $deliveryDate;
    }

    public function getShiftStart() : DateTime
    {
        return $this->shiftStart;
    }

    public function setShiftStart(DateTime $shiftStart) : void
    {
        $this->shiftStart = $shiftStart;
    }

    public function getShiftEnd() : DateTime
    {
        return $this->shiftEnd;
    }

    public function setShiftEnd(DateTime $shiftEnd) : void
    {
        $this->shiftEnd = $shiftEnd;
    }

    public function getWarehouseId() : string
    {
        return $this->warehouseId;
    }

    public function setWarehouseId(string $warehouseId) : void
    {
        $this->warehouseId = $warehouseId;
    }

    public function getWarehouseName() : string
    {
        return $this->warehouseName;
    }

    public function setWarehouseName(string $warehouseName) : void
    {
        $this->warehouseName = $warehouseName;
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
            'delivery_date' => $this->deliveryDate->format('Y-m-d'),
            'shift_start' => $this->shiftStart->format('H:i'),
            'shift_end' => $this->shiftEnd->format('H:i'),
            'warehouse_id' => $this->warehouseId,
            'warehouse_name' => $this->warehouseName,
        ];
    }
}
