<?php

declare(strict_types=1);

namespace PicupTechnologies\PicupPHPApi\Factories;

use PicupTechnologies\PicupPHPApi\Objects\Parcel;
use PicupTechnologies\PicupPHPApi\Objects\ParcelDimensions;

/**
 * Builds a Parcel including it's dimensions and weight
 */
final class ParcelFactory
{
    public static function make(array $data) : Parcel
    {
        $dimensions = $data['dimensions'];

        return new Parcel(
            $data['parcel_id'],
            $data['display_name'],
            new ParcelDimensions(
                $dimensions['height'],
                $dimensions['width'],
                $dimensions['length']
            ),
            $data['weight']
        );
    }
}
