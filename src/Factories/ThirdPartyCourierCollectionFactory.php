<?php

namespace PicupTechnologies\PicupPHPApi\Factories;

use PicupTechnologies\PicupPHPApi\Collections\ThirdPartyCourierCollection;
use PicupTechnologies\PicupPHPApi\Collections\ThirdPartyCourierFactory;

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
