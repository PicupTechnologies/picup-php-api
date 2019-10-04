<?php

namespace PicupTechnologies\PicupPHPApi\Objects;

class ParcelStatus
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

    /**
     * @return string
     */
    public function getReference(): string
    {
        return $this->reference;
    }

    /**
     * @return string
     */
    public function getTrackingNumber(): ?string
    {
        return $this->trackingNumber;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }
}
