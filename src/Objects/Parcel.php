<?php

declare(strict_types=1);

namespace PicupTechnologies\PicupPHPApi\Objects;

/**
 * Class Parcel
 *
 * Represents a parcel returned from the IntegrationDetails endpoint which
 * tells you which parcels are provided by Picup
 */
final class Parcel
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $displayName;

    /**
     * @var ParcelDimensions
     */
    private $dimensions;

    /**
     * @var int
     */
    private $weight;

    /**
     * Parcel constructor.
     */
    public function __construct(string $id, string $displayName, ParcelDimensions $dimensions, int $weight)
    {
        $this->id = $id;
        $this->displayName = $displayName;
        $this->dimensions = $dimensions;
        $this->weight = $weight;
    }

    public function getId() : string
    {
        return $this->id;
    }

    public function getDisplayName() : string
    {
        return $this->displayName;
    }

    public function getDimensions() : ParcelDimensions
    {
        return $this->dimensions;
    }

    public function getWeight() : int
    {
        return $this->weight;
    }

    /**
     * Returns whether or not an item with specific dimensions can fit into this parcel
     */
    public function canFit(ParcelDimensions $dimensions) : bool
    {
        if ($this->getDimensions()->getWidth() < $dimensions->getWidth()) {
            return false;
        }

        if ($this->getDimensions()->getHeight() < $dimensions->getHeight()) {
            return false;
        }

        if ($this->getDimensions()->getLength() < $dimensions->getLength()) {
            return false;
        }

        return true;
    }
}
