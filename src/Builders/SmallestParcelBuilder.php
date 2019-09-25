<?php

namespace PicupTechnologies\PicupPHPApi\Builders;

use PicupTechnologies\PicupPHPApi\Objects\Parcel;
use PicupTechnologies\PicupPHPApi\Objects\ParcelDimensions;

/**
 * Responsible for returning the smallest parcel that should
 * fit an item
 */
final class SmallestParcelBuilder
{
    /**
     * @var Parcel[]
     */
    protected $parcels;

    /**
     * Builds the parcel builder with the list of parcels allowed
     *
     * @param array $parcels
     */
    public function __construct(array $parcels)
    {
        $this->parcels = $parcels;
    }

    /**
     * Takes product dimensions and finds the smallest parcel that can fit
     * this product
     *
     * @param int $height Height of product
     * @param int $width  Width of product
     * @param int $length Length of product
     *
     * @return Parcel
     */
    public function find(int $height, int $width, int $length): ?Parcel
    {
        foreach ($this->parcels as $parcel) {
            $productDimensions = new ParcelDimensions($height, $width, $length);

            if ($parcel->canFit($productDimensions)) {
                return $parcel;
            }
        }

        return null;
    }
}
