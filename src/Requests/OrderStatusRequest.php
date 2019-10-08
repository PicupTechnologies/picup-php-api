<?php

declare(strict_types=1);

namespace PicupTechnologies\PicupPHPApi\Requests;

use JsonSerializable;
use PicupTechnologies\PicupPHPApi\Contracts\PicupRequestInterface;

final class OrderStatusRequest implements PicupRequestInterface, JsonSerializable
{
    /**
     * @var string[]
     */
    private $customerReferences;

    /**
     * OrderStatusRequest constructor.
     *
     * @param string[] $customerReferences
     */
    public function __construct(array $customerReferences)
    {
        $this->customerReferences = $customerReferences;
    }

    /**
     * @return string[]
     */
    public function getCustomerReferences() : array
    {
        return $this->customerReferences;
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
            'customer_references' => $this->customerReferences
        ];
    }
}
