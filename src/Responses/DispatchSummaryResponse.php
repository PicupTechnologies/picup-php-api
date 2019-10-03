<?php

namespace PicupTechnologies\PicupPHPApi\Responses;

use PicupTechnologies\PicupPHPApi\Objects\DispatchSummary\ParcelDetails;

/**
 * Holds the DispatchSummary response from Picup
 *
 * @package PicupTechnologies\PicupPHPApi\Responses
 */
final class DispatchSummaryResponse
{
    /**
     * @var int
     */
    private $picupCount;

    /**
     * @var int
     */
    private $totalParcels;

    /**
     * @var int
     */
    private $pendingParcels;

    /**
     * @var int
     */
    private $failedParcels;

    /**
     * @var int
     */
    private $completedParcels;

    /**
     * @var ParcelDetails[]
     */
    private $parcels;

    /**
     * DispatchSummaryResponse constructor.
     *
     * @param int             $picupCount
     * @param int             $totalParcels
     * @param int             $pendingParcels
     * @param int             $failedParcels
     * @param int             $completedParcels
     * @param ParcelDetails[] $parcels
     */
    public function __construct(int $picupCount, int $totalParcels, int $pendingParcels, int $failedParcels, int $completedParcels, array $parcels)
    {
        $this->picupCount = $picupCount;
        $this->totalParcels = $totalParcels;
        $this->pendingParcels = $pendingParcels;
        $this->failedParcels = $failedParcels;
        $this->completedParcels = $completedParcels;
        $this->parcels = $parcels;
    }

    /**
     * @return int
     */
    public function getPicupCount(): int
    {
        return $this->picupCount;
    }

    /**
     * @return int
     */
    public function getTotalParcels(): int
    {
        return $this->totalParcels;
    }

    /**
     * @return int
     */
    public function getPendingParcels(): int
    {
        return $this->pendingParcels;
    }

    /**
     * @return int
     */
    public function getFailedParcels(): int
    {
        return $this->failedParcels;
    }

    /**
     * @return int
     */
    public function getCompletedParcels(): int
    {
        return $this->completedParcels;
    }

    /**
     * @return ParcelDetails[]
     */
    public function getParcels(): array
    {
        return $this->parcels;
    }
}
