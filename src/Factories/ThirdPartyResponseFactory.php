<?php

namespace PicupTechnologies\PicupPHPApi\Factories;

use PicupTechnologies\PicupPHPApi\Objects\ThirdParty\ThirdPartyResponse;

final class ThirdPartyResponseFactory
{
    public static function make($decodedJsonObject): ThirdPartyResponse
    {
        $response = new ThirdPartyResponse();

        $response->setValid($decodedJsonObject->valid);
        $response->setError($decodedJsonObject->error);

        // Yes - the spelling of FULLFILLMENT is incorrect.

        if (!empty($decodedJsonObject->fullfillment_options)) {
            foreach ($decodedJsonObject->fullfillment_options as $fulfillmentOption) {
                $option = ThirdPartyFulfillmentOptionFactory::make($fulfillmentOption);
                $response->addFulfillmentOption($option);
            }
        }

        $response->setAllCollectionPrices(ThirdPartyCollectionCollectionFactory::make($decodedJsonObject->all_collection_prices));
        return $response;
    }
}
