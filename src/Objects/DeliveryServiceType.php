<?php

declare(strict_types=1);

namespace PicupTechnologies\PicupPHPApi\Objects;

use InvalidArgumentException;

/**
 * Class DeliveryServiceType
 *
 * Holds each service type containing the vehicle/cost etc for a picup quote
 *
 * @package PicupTechnologies\PicupPHPApi\Objects
 */
final class DeliveryServiceType
{
    /**
     * @var string
     */
    private $description;

    /**
     * @var float
     */
    private $priceInclusive;

    /**
     * @var float
     */
    private $priceExclusive;

    /**
     * @var float
     */
    private $distance;

    /**
     * @var string
     */
    private $duration;

    public function getDescription() : string
    {
        return $this->description;
    }

    public function setDescription(string $description) : void
    {
        $this->description = $description;
    }

    public function getPriceInclusive() : float
    {
        return $this->priceInclusive;
    }

    public function setPriceInclusive(float $priceInclusive) : void
    {
        $this->priceInclusive = $priceInclusive;
    }

    public function getPriceExclusive() : float
    {
        return $this->priceExclusive;
    }

    public function setPriceExclusive(float $priceExclusive) : void
    {
        $this->priceExclusive = $priceExclusive;
    }

    public function getDistance() : float
    {
        return $this->distance;
    }

    public function setDistance($distance) : void
    {
        $this->distance = (float)$distance;
    }

    public function getDuration() : string
    {
        return $this->duration;
    }

    public function setDuration(string $duration) : void
    {
        $this->duration = $duration;
    }

    /**
     * Returns just the name of the vehicle.
     *
     * description input: vehicle-motorcycle
     * vehicle output: Motorcycle
     *
     * input: vehicle-space-ship
     * output: Space Ship
     */
    public function getVehicleName() : string
    {
        if (strpos($this->description, '-') === false) {
            throw new InvalidArgumentException('Invalid vehicle name in description returned.');
        }

        $parts = explode('-', $this->description);

        array_shift($parts);

        $wholeAgain = implode('-', $parts);

        return ucwords(str_replace('-', ' ', $wholeAgain));
    }
}
