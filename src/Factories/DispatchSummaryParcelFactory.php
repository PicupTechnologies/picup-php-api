<?php

declare(strict_types=1);

namespace PicupTechnologies\PicupPHPApi\Factories;

use PicupTechnologies\PicupPHPApi\Objects\DispatchSummary\ParcelDetails;

/**
 * Builds the ParcelDetails for a DispatchSummaryResponse
 *
 * @package PicupTechnologies\PicupPHPApi\Factories
 */
final class DispatchSummaryParcelFactory
{
    /**
     * @param array $parcelArray
     *
     * @return ParcelDetails[]
     */
    public static function make(array $parcelArray) : array
    {
        $parcels = [];

        foreach ($parcelArray as $parcel) {
            $parcelDetails = new ParcelDetails(
                $parcel['tracking_number'],
                $parcel['parcel_reference'],
                $parcel['status'],
                $parcel['failed_reason'],
                $parcel['contact_name'],
                $parcel['contact_phone']
            );

            $parcels[] = $parcelDetails;
        }

        return $parcels;
    }
}
