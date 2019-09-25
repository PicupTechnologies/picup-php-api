<?php

namespace PicupTechnologies\PicupPHPApi\Objects;

/**
 * Class DeliveryServiceType
 *
 * Holds each service type containing the vehicle/cost etc for a picup quote
 *
 * @package App\Domains\Delivery\Objects
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
     * @var string
     */
    private $distance;

    /**
     * @var string
     */
    private $duration;

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
     * @return float
     */
    public function getPriceInclusive(): float
    {
        return $this->priceInclusive;
    }

    /**
     * @param float $priceInclusive
     */
    public function setPriceInclusive(float $priceInclusive): void
    {
        $this->priceInclusive = $priceInclusive;
    }

    /**
     * @return float
     */
    public function getPriceExclusive(): float
    {
        return $this->priceExclusive;
    }

    /**
     * @param float $priceExclusive
     */
    public function setPriceExclusive(float $priceExclusive): void
    {
        $this->priceExclusive = $priceExclusive;
    }

    /**
     * @return string
     */
    public function getDistance(): string
    {
        return $this->distance;
    }

    /**
     * @param string $distance
     */
    public function setDistance(string $distance): void
    {
        $this->distance = $distance;
    }

    /**
     * @return string
     */
    public function getDuration(): string
    {
        return $this->duration;
    }

    /**
     * @param string $duration
     */
    public function setDuration(string $duration): void
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
     *
     * @return string
     */
    public function getVehicleName(): string
    {
        if (stripos($this->description, '-') === false) {
          throw new InvalidArgumentException('Invalid vehicle name in description returned.');
        }

        $parts = explode('-', $this->description);

        array_shift($parts);

        $wholeAgain = implode('-', $parts);

        return ucwords(str_replace('-', ' ', $wholeAgain));
    }
}
