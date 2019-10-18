<?php

declare(strict_types=1);

namespace PicupTechnologies\PicupPHPApi\Objects;

/**
 * Class ParcelStatus
 *
 * @package PicupTechnologies\PicupPHPApi\Objects
 */
final class ParcelStatus
{
    /**
     * @var string
     */
    private $reference;

    /**
     * @var string
     */
    private $trackingNumber;

    /**
     * @var string
     */
    private $status;

    /**
     * ParcelStatus constructor.
     *
     * @param string $reference
     * @param string $status
     * @param string $trackingNumber
     */
    public function __construct(string $reference, string $status, ?string $trackingNumber)
    {
        $this->reference = $reference;
        $this->status = $status;
        $this->trackingNumber = $trackingNumber;
    }

    public function getReference() : string
    {
        return $this->reference;
    }

    /**
     * @return string
     */
    public function getTrackingNumber() : ?string
    {
        return $this->trackingNumber;
    }

    public function getStatus() : string
    {
        return $this->status;
    }
}
