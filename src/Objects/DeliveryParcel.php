<?php

declare(strict_types=1);


namespace PicupTechnologies\PicupPHPApi\Objects;

/**
 * Class DeliveryParcel
 *
 * Represents a single parcel in a delivery quote
 */
class DeliveryParcel implements \JsonSerializable
{
    /**
     * @var string
     */
    private $reference;

    /**
     * @var string
     */
    private $size;

    /**
     * DeliveryParcel constructor.
     */
    public function __construct(string $reference, string $size)
    {
        $this->reference = $reference;
        $this->size = $size;
    }

    public function getReference() : string
    {
        return $this->reference;
    }

    public function getSize() : string
    {
        return $this->size;
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
            'reference' => $this->reference,
            'size' => $this->size
        ];
    }
}
