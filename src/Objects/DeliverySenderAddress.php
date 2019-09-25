<?php
/**
 * Created by PhpStorm.
 * User: bryan
 * Date: 2018/10/22
 * Time: 5:10 PM
 */

namespace PicupTechnologies\PicupPHPApi\Objects;

use JsonSerializable;

class DeliverySenderAddress extends DeliveryAddress implements JsonSerializable
{
    private $warehouseId = 'warehouse-49c740f0-82e2-4f60-9064-79101cfaba17';

    /**
     * @return string
     */
    public function getWarehouseId(): string
    {
        return $this->warehouseId;
    }

    /**
     * @param string $warehouseId
     */
    public function setWarehouseId(string $warehouseId): void
    {
        $this->warehouseId = $warehouseId;
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
        return parent::jsonSerialize() + [
            'warehouse_id' => $this->warehouseId
            ];
    }
}
