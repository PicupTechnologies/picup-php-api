<?php

namespace PicupTechnologies\PicupPHPApi\Factories;

use DateTime;
use PicupTechnologies\PicupPHPApi\Objects\ThirdParty\ThirdPartyFulfillmentCollection;

final class ThirdPartyFulfillmentCollectionFactory
{
    /**
     * @param $decodedJsonObject
     *
     * @return ThirdPartyFulfillmentCollection
     */
    public static function make($decodedJsonObject): ThirdPartyFulfillmentCollection
    {
        $response = new ThirdPartyFulfillmentCollection();

        $response->setBucketId($decodedJsonObject->bucket_id);
        $response->setCollectionDate(DateTime::createFromFormat('Y-m-d\TH:i:sZ', $decodedJsonObject->collection_date));
        $response->setCollectionStartTime(DateTime::createFromFormat('H:i:s', $decodedJsonObject->collection_start_time));
        $response->setCollectionEndTime(DateTime::createFromFormat('H:i:s', $decodedJsonObject->collection_end_time));
        $response->setDeliveryDate(DateTime::createFromFormat('Y-m-d\TH:i:sZ', $decodedJsonObject->delivery_date));
        $response->setCollectionReference($decodedJsonObject->collection_reference);
        $response->setBusinessId($decodedJsonObject->business_id);
        $response->setUserId($decodedJsonObject->user_id);
        $response->setWarehouseId($decodedJsonObject->warehouse_id);
        $response->setWaybill(ThirdPartyWaybillFactory::make($decodedJsonObject->waybill));

        return $response;
    }
}
