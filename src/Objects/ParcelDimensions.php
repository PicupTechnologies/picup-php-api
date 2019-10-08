<?php

declare(strict_types=1);

namespace PicupTechnologies\PicupPHPApi\Objects;

/**
 * Represents the dimensions for a parcel
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
     */
    public function __construct(int $height, int $width, int $length)
    {
        $this->height = $height;
        $this->width = $width;
        $this->length = $length;
    }

    public function getHeight() : int
    {
        return $this->height;
    }

    public function getWidth() : int
    {
        return $this->width;
    }

    public function getLength() : int
    {
        return $this->length;
    }

    /**
     * Returns the total surface area of the parcel
     */
    public function getArea() : int
    {
        return $this->height * $this->width * $this->length;
    }
}
