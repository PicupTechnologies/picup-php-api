<?php

declare(strict_types=1);

namespace PicupTechnologies\PicupPHPApi\Objects;

/**
 * Class DeliveryReceiverContact
 *
 * @package PicupTechnologies\PicupPHPApi\Objects
 */
final class DeliveryReceiverContact extends DeliveryContact
{
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
            'name' => $this->getName(),
            'email' => $this->getEmail(),
            'telephone' => $this->getTelephone(),
            'cellphone' => $this->getCellphone()
        ];
    }
}
