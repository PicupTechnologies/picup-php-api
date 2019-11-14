<?php

namespace PicupTechnologies\PicupPHPApi\Factories;

use DateTime;
use PicupTechnologies\PicupPHPApi\Objects\ThirdParty\FulfillmentBreakdown;

/**
 * Class ThirdPartyFulfillmentBreakdownFactory
 *
 * @package PicupTechnologies\PicupPHPApi\Factories
 */
final class ThirdPartyFulfillmentBreakdownFactory
{
    /**
     * @param $decodedJsonObject
     *
     * @return FulfillmentBreakdown
     */
    public static function make($decodedJsonObject): FulfillmentBreakdown
    {
        $response = new FulfillmentBreakdown();

        $response->setParcelReferences($decodedJsonObject->parcel_references);
        $response->setServiceType($decodedJsonObject->service_type);
        $response->setCourierCode($decodedJsonObject->courier_code);
        $response->setPriceIncVat($decodedJsonObject->price_incl_vat);
        $response->setPriceExVat($decodedJsonObject->price_ex_vat);
        $response->setCollectedBefore(DateTime::createFromFormat('Y-m-d\TH:i:sZ', $decodedJsonObject->collected_before));
        $response->setDeliveredBefore(DateTime::createFromFormat('Y-m-d\TH:i:sZ', $decodedJsonObject->delivered_before));

        return $response;
    }
}
