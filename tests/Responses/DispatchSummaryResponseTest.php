<?php

namespace PicupTechnologies\PicupPHPApi\Tests\Responses;

use PHPUnit\Framework\TestCase;
use PicupTechnologies\PicupPHPApi\Objects\DispatchSummary\ParcelDetails;
use PicupTechnologies\PicupPHPApi\Responses\DispatchSummaryResponse;

class DispatchSummaryResponseTest extends TestCase
{
    public function testGetters(): void
    {
        $picupCount = 1;
        $totalParcels = 2;
        $pendingParcels = 3;
        $failedParcels = 4;
        $completedParcels = 5;

        $parcelDetail = new ParcelDetails(
            'tracking',
            'parcel-ref',
            'pending',
            null,
            'name',
            'phone'
        );

        $dispatchSummary = new DispatchSummaryResponse(
            $picupCount,
            $totalParcels,
            $pendingParcels,
            $failedParcels,
            $completedParcels,
            [$parcelDetail]
        );

        $this->assertEquals($picupCount, $dispatchSummary->getPicupCount());
        $this->assertEquals($totalParcels, $dispatchSummary->getTotalParcels());
        $this->assertEquals($pendingParcels, $dispatchSummary->getPendingParcels());
        $this->assertEquals($failedParcels, $dispatchSummary->getFailedParcels());
        $this->assertEquals($completedParcels, $dispatchSummary->getCompletedParcels());

        $parcel = $dispatchSummary->getParcels()[0];
        $this->assertEquals('tracking', $parcel->getTrackingNumber());
        $this->assertEquals('parcel-ref', $parcel->getParcelReference());
        $this->assertEquals('pending', $parcel->getStatus());
        $this->assertEquals(null, $parcel->getFailedReason());
        $this->assertEquals('name', $parcel->getContactName());
        $this->assertEquals('phone', $parcel->getContactPhone());
    }
}
