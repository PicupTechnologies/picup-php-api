<?php

namespace PicupTechnologies\PicupPHPApi\Factories;

use PicupTechnologies\PicupPHPApi\Objects\ParcelDimensions;
use PicupTechnologies\PicupPHPApi\Objects\ThirdParty\ThirdPartyParcel;

final class ThirdPartyParcelFactory
{
    public static function make($decodedJsonObject): ThirdPartyParcel
    {
        $response = new ThirdPartyParcel();
        $response->setId($decodedJsonObject->parcel_id);
        $response->setDescription($decodedJsonObject->description);

        $dimensions = new ParcelDimensions(
            $decodedJsonObject->height,
            $decodedJsonObject->width,
            $decodedJsonObject->length
        );

        $response->setDimensions($dimensions);
        $response->setMass($decodedJsonObject->mass);
        $response->setStatus($decodedJsonObject->status);

        return $response;
    }
}
