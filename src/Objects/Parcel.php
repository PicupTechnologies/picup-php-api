<?php

declare(strict_types=1);

namespace PicupTechnologies\PicupPHPApi\Objects;

use InvalidArgumentException;

/**
 * Represents a Parcel handled by Picup
 *
 * @package PicupTechnologies\PicupPHPApi\Objects
 */
final class Parcel
{
    /**
     * The ID of this parcel (ex parcel-small)
     *
     * @var string
     */
    private $id;

    /**
     * Description of this parcel (Small Parcel)
     *
     * @var string
     */
    private $description;

    /**
     * Dimensions of this parcel
     *
     * @var ParcelDimensions
     */
    private $dimensions;

    /**
     * The parcel weight
     *
     * @var float
     */
    private $weight;

    /**
     * Tracking number for parcel
     *
     * @var string
     */
    private $trackingNumber;

    /**
     * Customer reference for the parcel
     *
     * @var string
     */
    private $reference;

    /**
     * Parcel constructor.
     *
     * @param string           $id
     * @param string           $description
     */
    public function __construct(string $id, string $description)
    {
        $this->id = $id;
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return ParcelDimensions
     */
    public function getDimensions(): ?ParcelDimensions
    {
        return $this->dimensions;
    }

    /**
     * @param ParcelDimensions $dimensions
     */
    public function setDimensions(ParcelDimensions $dimensions): void
    {
        $this->dimensions = $dimensions;
    }

    /**
     * @return float
     */
    public function getWeight(): ?float
    {
        return $this->weight;
    }

    /**
     * @param float $weight
     */
    public function setWeight($weight): void
    {
        $this->weight = (float)$weight;
    }

    /**
     * @return string
     */
    public function getTrackingNumber(): ?string
    {
        return $this->trackingNumber;
    }

    /**
     * @param string $trackingNumber
     */
    public function setTrackingNumber(string $trackingNumber): void
    {
        $this->trackingNumber = $trackingNumber;
    }

    /**
     * @return string
     */
    public function getReference(): ?string
    {
        return $this->reference;
    }

    /**
     * @param string $reference
     */
    public function setReference(string $reference): void
    {
        $this->reference = $reference;
    }

    /**
     * Returns whether or not an item with specific dimensions can fit into this parcel
     *
     * @param ParcelDimensions $dimensions
     * @throws InvalidArgumentException
     * @return bool
     */
    public function canFit(ParcelDimensions $dimensions) : bool
    {
        if (! $this->getDimensions() instanceof ParcelDimensions) {
            throw new InvalidArgumentException('Cannot check dimensions. No parcel dimensions are set.');
        }

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
