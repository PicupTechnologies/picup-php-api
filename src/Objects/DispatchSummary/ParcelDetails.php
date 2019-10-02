<?php

namespace PicupTechnologies\PicupPHPApi\Objects\DispatchSummary;

class ParcelDetails
{
    /**
     * @var string
     */
    private $trackingNumber;

    /**
     * @var string
     */
    private $parcelReference;

    /**
     * @var string
     */
    private $status;

    /**
     * @var string
     */
    private $failedReason;

    /**
     * @var string
     */
    private $contactName;

    /**
     * @var string
     */
    private $contactPhone;

    /**
     * ParcelDetails constructor.
     *
     * @param string $trackingNumber
     * @param string $parcelReference
     * @param string $status
     * @param string $failedReason
     * @param string $contactName
     * @param string $contactPhone
     */
    public function __construct(?string $trackingNumber, string $parcelReference, string $status, ?string $failedReason, string $contactName, string $contactPhone)
    {
        $this->trackingNumber = $trackingNumber;
        $this->parcelReference = $parcelReference;
        $this->status = $status;
        $this->failedReason = $failedReason;
        $this->contactName = $contactName;
        $this->contactPhone = $contactPhone;
    }

    /**
     * @return string
     */
    public function getTrackingNumber(): string
    {
        return $this->trackingNumber;
    }

    /**
     * @return string
     */
    public function getParcelReference(): string
    {
        return $this->parcelReference;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getFailedReason(): ?string
    {
        return $this->failedReason;
    }

    /**
     * @return string
     */
    public function getContactName(): string
    {
        return $this->contactName;
    }

    /**
     * @return string
     */
    public function getContactPhone(): string
    {
        return $this->contactPhone;
    }
}
