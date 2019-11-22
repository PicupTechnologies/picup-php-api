<?php

declare(strict_types=1);

namespace PicupTechnologies\PicupPHPApi\Factories;

use PicupTechnologies\PicupPHPApi\Objects\Parcel;
use PicupTechnologies\PicupPHPApi\Objects\ParcelDimensions;

/**
 * Builds a Parcel including it's dimensions and weight
 *
 * @package PicupTechnologies\PicupPHPApi\Factories
 */
final class ParcelFactory
{
    /**
     * @param array $data
     *
     * @return Parcel
     */
    public static function make(array $data) : Parcel
    {
        $dimensions = $data['dimensions'];

        $parcel = new Parcel();
        $parcel->setId($data['parcel_id']);
        $parcel->setDescription($data['display_name']);

        $parcel->setDimensions(new ParcelDimensions($dimensions['height'], $dimensions['width'], $dimensions['length']));
        $parcel->setWeight((float)$data['weight']);

        return $parcel;
    }
}
