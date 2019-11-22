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

        if (! $response->isValid()) {
          return $response;
        }

        // Yes - the spelling of FULLFILLMENT is incorrect.

        if (!empty($decodedJsonObject->fullfillment_options)) {
            foreach ($decodedJsonObject->fullfillment_options as $fulfillmentOption) {
                $option = ThirdPartyFulfillmentOptionFactory::make($fulfillmentOption);
                $response->addFulfillmentOption($option);
            }
        }

        if (!empty($decodedJsonObject->all_collection_prices)) {
            $response->setAllCollectionPrices(ThirdPartyCollectionCollectionFactory::make($decodedJsonObject->all_collection_prices));
        }

        return $response;
    }
}
