<?php

declare(strict_types=1);

namespace PicupTechnologies\PicupPHPApi\Factories;

use PicupTechnologies\PicupPHPApi\Objects\DeliveryServiceType;
use PicupTechnologies\PicupPHPApi\Responses\DeliveryQuoteResponse;

/**
 * Builds a DeliveryQuoteResponse
 */
final class DeliveryQuoteResponseFactory
{
    /**
     * Factory function to build a quote response
     */
    public static function make(string $body) : DeliveryQuoteResponse
    {
        $decodedObject = json_decode($body, false);

        $quoteResponse = new DeliveryQuoteResponse();

        if ((int) $decodedObject->picup->valid !== 1) {
            $quoteResponse->setValid(false);
            $quoteResponse->setError($decodedObject->picup->error);

            return $quoteResponse;
        }

        $quoteResponse->setValid(true);

        foreach ($decodedObject->picup->service_types as $service_type) {
            $deliveryServiceType = new DeliveryServiceType();

            $deliveryServiceType->setDescription($service_type->description);
            $deliveryServiceType->setPriceInclusive($service_type->price_incl_vat);
            $deliveryServiceType->setPriceExclusive($service_type->price_ex_vat);
            $deliveryServiceType->setDuration($service_type->duration);
            $deliveryServiceType->setDistance($service_type->distance);

            $quoteResponse->addServiceType($deliveryServiceType);
        }

        return $quoteResponse;
    }
}
