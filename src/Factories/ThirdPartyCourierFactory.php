<?php

namespace PicupTechnologies\PicupPHPApi\Factories;

use PicupTechnologies\PicupPHPApi\Objects\ThirdParty\ThirdPartyCourier;

final class ThirdPartyCourierFactory
{
    public static function make($decodedJsonObject): ThirdPartyCourier
    {
        $response = new ThirdPartyCourier();

        $response->setCourier($decodedJsonObject->courier);
        $response->setCourierCode($decodedJsonObject->courier_code);
        $response->setCourierName($decodedJsonObject->courier_name);

        if ($decodedJsonObject->service_prices) {
            $response->setServicePrices(ThirdPartyServicePriceCollectionFactory::make($decodedJsonObject->service_prices));
        }

        $response->setTotalQuotes($decodedJsonObject->total_quotes);
        $response->setSuccess($decodedJsonObject->success);
        $response->setInternalError($decodedJsonObject->internal_error);
        $response->setError($decodedJsonObject->error);

        return $response;
    }
}
