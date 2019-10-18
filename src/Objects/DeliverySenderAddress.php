<?php

declare(strict_types=1);

namespace PicupTechnologies\PicupPHPApi\Objects;

use JsonSerializable;

final class DeliverySenderAddress extends DeliveryAddress implements JsonSerializable
{
    /**
     * @var string
     */
    private $warehouseId;

    /**
     * @return string
     */
    public function getWarehouseId() : ?string
    {
        return $this->warehouseId;
    }

    public function setWarehouseId(string $warehouseId) : void
    {
        $this->warehouseId = $warehouseId;
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
        $items = parent::jsonSerialize();

        if (isset($this->warehouseId) && $this->warehouseId) {
            $items['warehouse_id'] = $this->warehouseId;
        }

        return $items;
    }
}
