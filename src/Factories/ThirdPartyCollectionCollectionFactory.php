<?php

namespace PicupTechnologies\PicupPHPApi\Factories;

use PicupTechnologies\PicupPHPApi\Objects\ThirdParty\ThirdPartyCollectionCollection;

/**
 * Builds a collection of ThirdPartyCollections
 *
 * @package PicupTechnologies\PicupPHPApi\Factories
 */
final class ThirdPartyCollectionCollectionFactory
{
    /**
     * @param $decodedJsonObject
     *
     * @return ThirdPartyCollectionCollection
     */
    public static function make($decodedJsonObject): ThirdPartyCollectionCollection
    {
        $collectionCollection = new ThirdPartyCollectionCollection();

        foreach ($decodedJsonObject as $sourceCollection) {
            $collectionCollection->addCollection(ThirdPartyFulfillmentCollectionFactory::make($sourceCollection->collection));

            // When this is called in the context of the AllCourierPrices then
            // there is also a collection of couriers with service prices included

            if (isset($sourceCollection->couriers)) {
                $courierCollection = ThirdPartyCourierCollectionFactory::make($sourceCollection->couriers);
                $collectionCollection->setCouriers($courierCollection);
            }

            if (isset($sourceCollection->courier_code)) {
                $collectionCollection->setCourierCode($sourceCollection->courier_code);
            }

            if (isset($sourceCollection->service_type)) {
                $collectionCollection->setServiceType($sourceCollection->service_type);
            }

            if (isset($sourceCollection->total_quotes)) {
                $collectionCollection->setTotalQuotes($sourceCollection->total_quotes);
            }
        }

        return $collectionCollection;
    }
}
