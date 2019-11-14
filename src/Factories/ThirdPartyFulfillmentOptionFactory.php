<?php

namespace PicupTechnologies\PicupPHPApi\Factories;

use DateTime;
use PicupTechnologies\PicupPHPApi\Objects\ThirdParty\ThirdPartyFulfillmentOption;

/**
 * Class ThirdPartyFulfillmentOptionFactory
 *
 * @package PicupTechnologies\PicupPHPApi\Factories
 */
final class ThirdPartyFulfillmentOptionFactory
{
    /**
     * @param $decodedJsonObject
     *
     * @return ThirdPartyFulfillmentOption
     */
    public static function make($decodedJsonObject): ThirdPartyFulfillmentOption
    {
        $option = new ThirdPartyFulfillmentOption();

        $option->setDescription($decodedJsonObject->description);
        $option->setPriceIncVat($decodedJsonObject->price_incl_vat);
        $option->setPriceExVat($decodedJsonObject->price_ex_vat);
        $option->setCollectedBefore(DateTime::createFromFormat('Y-m-d\TH:i:sZ', $decodedJsonObject->collected_before));
        $option->setDeliveredBefore(DateTime::createFromFormat('Y-m-d\TH:i:sZ', $decodedJsonObject->delivered_before));
        $option->setCollections(ThirdPartyCollectionCollectionFactory::make($decodedJsonObject->collections));

        foreach ($decodedJsonObject->fullfillment_breakdown as $sourceFulfillmentBreakdown) {
            $option->addFulfillmentBreakdown(ThirdPartyFulfillmentBreakdownFactory::make($sourceFulfillmentBreakdown));
        }

        return $option;
    }
}
