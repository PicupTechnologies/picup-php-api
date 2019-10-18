<?php

declare(strict_types=1);

namespace PicupTechnologies\PicupPHPApi\Responses;

use PicupTechnologies\PicupPHPApi\Objects\Parcel;
use PicupTechnologies\PicupPHPApi\Objects\Warehouses\DeliveryWarehouse;

/**
 * Holds the DeliveryIntegrationDetails response from Picup
 *
 * @package PicupTechnologies\PicupPHPApi\Responses
 */
final class DeliveryIntegrationDetailsResponse
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
     * List of parcel sizes allowed for this account
     *
     * @var Parcel[]
     */
    private $parcels;

    /**
     * DeliveryIntegrationDetailsResponse constructor.
     *
     * @param bool                $isKeyValid
     * @param string              $isKeyValidMessage
     * @param DeliveryWarehouse[] $warehouses
     * @param Parcel[]            $parcels
     */
    public function __construct(bool $isKeyValid, string $isKeyValidMessage, array $warehouses, array $parcels)
    {
        $this->isKeyValid = $isKeyValid;
        $this->isKeyValidMessage = $isKeyValidMessage;
        $this->warehouses = $warehouses;
        $this->parcels = $parcels;
    }

    public function isKeyValid() : bool
    {
        return $this->isKeyValid;
    }

    public function getIsKeyValidMessage() : string
    {
        return $this->isKeyValidMessage;
    }

    /**
     * @return DeliveryWarehouse[]
     */
    public function getWarehouses() : ?array
    {
        return $this->warehouses;
    }

    /**
     * @return Parcel[]
     */
    public function getParcels() : ?array
    {
        return $this->parcels;
    }
}
