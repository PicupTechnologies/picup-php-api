<?php

namespace PicupTechnologies\PicupPHPApi\Factories;

use PicupTechnologies\PicupPHPApi\Objects\Parcel;
use PicupTechnologies\PicupPHPApi\Objects\ParcelDimensions;

final class ParcelFactory
{
    /**
     * @param array $data
     *
     * @return Parcel
     */
    public static function make(array $data): Parcel
    {
        $dimensions = $data['dimensions'];

        $parcel = new Parcel(
            $data['parcel_id'],
            $data['display_name'],
            new ParcelDimensions(
                $dimensions['height'],
                $dimensions['width'],
                $dimensions['length']
            ),
            $data['weight']
        );

        return $parcel;
    }
}