<?php

declare(strict_types=1);

namespace PicupTechnologies\PicupPHPApi\Tests\Responses;

use PHPUnit\Framework\TestCase;
use PicupTechnologies\PicupPHPApi\Objects\DispatchSummary\ParcelDetails;
use PicupTechnologies\PicupPHPApi\Responses\DispatchSummaryResponse;

class DispatchSummaryResponseTest extends TestCase
{
    public function testGetters() : void
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

        $this->assertSame($picupCount, $dispatchSummary->getPicupCount());
        $this->assertSame($totalParcels, $dispatchSummary->getTotalParcels());
        $this->assertSame($pendingParcels, $dispatchSummary->getPendingParcels());
        $this->assertSame($failedParcels, $dispatchSummary->getFailedParcels());
        $this->assertSame($completedParcels, $dispatchSummary->getCompletedParcels());

        $parcel = $dispatchSummary->getParcels()[0];
        $this->assertSame('tracking', $parcel->getTrackingNumber());
        $this->assertSame('parcel-ref', $parcel->getParcelReference());
        $this->assertSame('pending', $parcel->getStatus());
        $this->assertNull($parcel->getFailedReason());
        $this->assertSame('name', $parcel->getContactName());
        $this->assertSame('phone', $parcel->getContactPhone());
    }
}
