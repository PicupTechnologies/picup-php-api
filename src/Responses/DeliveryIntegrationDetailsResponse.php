<?php

namespace PicupTechnologies\PicupPHPApi\Responses;

use PicupTechnologies\PicupPHPApi\Objects\Warehouses\DeliveryWarehouse;

class DeliveryIntegrationDetailsResponse
{
    /**
     * Whether this key is valid or not
     *
     * @var bool
     */
    private $isKeyValid;

    /**
     * Textual message of whether key is valid or not
     *
     * @var string
     */
    private $isKeyValidMessage;

    /**
     * List of Warehouses that this ApiKey is valid for
     *
     * @var DeliveryWarehouse[]
     */
    private $warehouses;

    /**
     * DeliveryIntegrationDetailsResponse constructor.
     *
     * @param bool                $isKeyValid
     * @param string              $isKeyValidMessage
     * @param DeliveryWarehouse[] $warehouses
     */
    public function __construct(bool $isKeyValid, string $isKeyValidMessage, array $warehouses)
    {
        $this->isKeyValid = $isKeyValid;
        $this->isKeyValidMessage = $isKeyValidMessage;
        $this->warehouses = $warehouses;
    }

    /**
     * @return bool
     */
    public function isKeyValid(): bool
    {
        return $this->isKeyValid;
    }

    /**
     * @return string
     */
    public function getIsKeyValidMessage(): string
    {
        return $this->isKeyValidMessage;
    }

    /**
     * @return DeliveryWarehouse[]
     */
    public function getWarehouses(): array
    {
        return $this->warehouses;
    }
}
