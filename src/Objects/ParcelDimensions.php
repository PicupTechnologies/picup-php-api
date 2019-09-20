<?php

namespace PicupTechnologies\PicupPHPApi\Objects;

/**
 * Class ParcelDimensions
 *
 * Represents a single parcel WIDTH/HEIGHT+LENGTH
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
     * @return mixed
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @return mixed
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @return mixed
     */
    public function getLength()
    {
        return $this->length;
    }
}
