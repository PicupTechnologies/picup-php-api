<?php

namespace PicupTechnologies\PicupPHPApi\Collections;

use JsonSerializable;
use PicupTechnologies\PicupPHPApi\Objects\ThirdParty\ThirdPartyCourier;

/**
 * Class ThirdPartyCourierCollection
 *
 * @package PicupTechnologies\PicupPHPApi\Collections
 */
final class ThirdPartyCourierCollection implements JsonSerializable
{
    /**
     * @var ThirdPartyCourier[]
     */
    private $couriers;

    /**
     * @return ThirdPartyCourier[]
     */
    public function getCouriers(): array
    {
        return $this->couriers;
    }

    /**
     * @param ThirdPartyCourier[] $couriers
     */
    public function setCouriers(array $couriers): void
    {
        $this->couriers = $couriers;
    }

    public function addCourier(ThirdPartyCourier $courier): void
    {
        $this->couriers[] = $courier;
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
        return $this->getCouriers();
    }
}
