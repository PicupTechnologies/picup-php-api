<?php

namespace PicupTechnologies\PicupPHPApi\Factories;

use PicupTechnologies\PicupPHPApi\Collections\ThirdPartyCourierCollection;

final class ThirdPartyCourierCollectionFactory
{
    public static function make($decodedJsonObject): ThirdPartyCourierCollection
    {
        $response = new ThirdPartyCourierCollection();

        foreach ($decodedJsonObject as $sourceCourier) {
            $response->addCourier(ThirdPartyCourierFactory::make($sourceCourier));
        }

        return $response;
    }
}
