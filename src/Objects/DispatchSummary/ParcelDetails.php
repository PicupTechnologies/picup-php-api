<?php

declare(strict_types=1);

namespace PicupTechnologies\PicupPHPApi\Objects\DispatchSummary;

/**
 * Class ParcelDetails
 *
 * @package PicupTechnologies\PicupPHPApi\Objects\DispatchSummary
 */
final class ParcelDetails
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

    public function getTrackingNumber() : string
    {
        return $this->trackingNumber;
    }

    public function getParcelReference() : string
    {
        return $this->parcelReference;
    }

    public function getStatus() : string
    {
        return $this->status;
    }

    public function getFailedReason() : ?string
    {
        return $this->failedReason;
    }

    public function getContactName() : string
    {
        return $this->contactName;
    }

    public function getContactPhone() : string
    {
        return $this->contactPhone;
    }
}
