<?php

namespace PicupTechnologies\PicupPHPApi\Objects;

/**
 * Class Parcel
 *
 * Represents a parcel returned from the IntegrationDetails endpoint which
 * tells you which parcels are provided by Picup
 *
 * @package PicupTechnologies\PicupPHPApi\Objects
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
     *
     * @param string           $id
     * @param string           $displayName
     * @param ParcelDimensions $dimensions
     * @param int              $weight
     */
    public function __construct(string $id, string $displayName, ParcelDimensions $dimensions, int $weight)
    {
        $this->id = $id;
        $this->displayName = $displayName;
        $this->dimensions = $dimensions;
        $this->weight = $weight;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getDisplayName(): string
    {
        return $this->displayName;
    }

    /**
     * @return ParcelDimensions
     */
    public function getDimensions(): ParcelDimensions
    {
        return $this->dimensions;
    }

    /**
     * @return int
     */
    public function getWeight(): int
    {
        return $this->weight;
    }

    /**
     * Returns whether or not an item with specific dimensions can fit into this parcel
     *
     * @param ParcelDimensions $dimensions
     *
     * @return bool
     */
    public function canFit(ParcelDimensions $dimensions): bool
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
