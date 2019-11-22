<?php

namespace PicupTechnologies\PicupPHPApi\Factories;

use PicupTechnologies\PicupPHPApi\Objects\ThirdParty\ThirdPartyWaybill;

final class ThirdPartyWaybillFactory
{
    public static function make($decodedJsonObject): ThirdPartyWaybill
    {
        $response = new ThirdPartyWaybill();

        $response->setOrderId($decodedJsonObject->order_id);
        $response->setWaybillNumber($decodedJsonObject->waybill_number);
        $response->setCourierOrderId($decodedJsonObject->courier_order_id);
        $response->setCustomerReference($decodedJsonObject->customer_reference);
        $response->setBusinessReference($decodedJsonObject->business_reference);
        $response->setCourierCode($decodedJsonObject->courier_code);
        $response->setCourierServiceType($decodedJsonObject->courier_service_type);
        $response->setServiceType($decodedJsonObject->service_type);
        $response->setPrice($decodedJsonObject->price);
        $response->setReconciledPrice($decodedJsonObject->reconciled_price);

        $response->setOrigin(ThirdPartyWaybillAddressFactory::makeOrigin($decodedJsonObject->origin));
        $response->setDestination(ThirdPartyWaybillAddressFactory::makeDestination($decodedJsonObject->destination));

        foreach ($decodedJsonObject->parcels as $sourceParcel) {
            $response->addParcel(ThirdPartyParcelFactory::make($sourceParcel));
        }

        return $response;
    }
}
