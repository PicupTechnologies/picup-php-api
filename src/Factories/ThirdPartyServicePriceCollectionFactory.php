<?php


namespace PicupTechnologies\PicupPHPApi\Factories;

use DateTime;
use Money\Money;
use PicupTechnologies\PicupPHPApi\Objects\ThirdParty\ThirdPartyServicePrice;
use PicupTechnologies\PicupPHPApi\Objects\ThirdParty\ThirdPartyServicePriceCollection;

final class ThirdPartyServicePriceCollectionFactory
{
    public static function make($decodedJsonObject): ThirdPartyServicePriceCollection
    {
        $collection = new ThirdPartyServicePriceCollection();

        foreach ($decodedJsonObject as $sourceServicePrice) {
            $servicePrice = new ThirdPartyServicePrice();

            $servicePrice->setServiceType($sourceServicePrice->service_type);
            $servicePrice->setServiceTypeDescription($sourceServicePrice->service_type_description);

            // Convert the money values to cents
            $servicePrice->setExVat(Money::ZAR((int)($sourceServicePrice->ex_vat * 100)));
            $servicePrice->setVat(Money::ZAR((int)($sourceServicePrice->vat * 100)));
            $servicePrice->setIncVat(Money::ZAR((int)($sourceServicePrice->inc_vat * 100)));

            $servicePrice->setDeliverDate(DateTime::createFromFormat('Y-m-d\TH:i:sZ', $sourceServicePrice->deliver_date));
            $servicePrice->setTimeIndicator($sourceServicePrice->time_indicator);
            $servicePrice->setCollectionTime(DateTime::createFromFormat('U', $sourceServicePrice->collection_time_unix_epoch));
            $servicePrice->setDeliveryTime(DateTime::createFromFormat('U', $sourceServicePrice->delivery_time_unix_epoch));
            $servicePrice->setSuccess($sourceServicePrice->success);
            $servicePrice->setInternalError($sourceServicePrice->internal_error);
            $servicePrice->setError($sourceServicePrice->error);

            $collection->addServicePrices($servicePrice);
        }

        return $collection;
    }
}
