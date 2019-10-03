<?php

namespace PicupTechnologies\PicupPHPApi\Objects;

/**
 * Represents the dimensions for a parcel
 *
 * @package PicupTechnologies\PicupPHPApi\Objects
 */
final class ParcelDimensions
{
    /**
     * @var int
     */
    private $height;

    /**
     * @var int
     */
    private $width;

    /**
     * @var int
     */
    private $length;

    /**
     * ParcelDimensions constructor.
     *
     * @param int $height
     * @param int $width
     * @param int $length
     */
    public function __construct(int $height, int $width, int $length)
    {
        $this->height = $height;
        $this->width = $width;
        $this->length = $length;
    }

    /**
     * @return int
     */
    public function getHeight(): int
    {
        return $this->height;
    }

    /**
     * @return int
     */
    public function getWidth(): int
    {
        return $this->width;
    }

    /**
     * @return int
     */
    public function getLength(): int
    {
        return $this->length;
    }

    /**
     * Returns the total surface area of the parcel
     *
     * @return int
     */
    public function getArea(): int
    {
        return $this->height * $this->width * $this->length;
    }
}
