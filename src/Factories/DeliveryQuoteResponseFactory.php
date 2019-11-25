<?php

declare(strict_types=1);

namespace PicupTechnologies\PicupPHPApi\Factories;

use PicupTechnologies\PicupPHPApi\Exceptions\PicupApiException;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryServiceType;
use PicupTechnologies\PicupPHPApi\Responses\DeliveryQuoteResponse;

/**
 * Builds a DeliveryQuoteResponse
 *
 * @package PicupTechnologies\PicupPHPApi\Factories
 */
final class DeliveryQuoteResponseFactory
{
    /**
     * Factory function to build a quote response
     *
     * This must be able to handle a situation where Picup does not service an area
     * but a ThirdParty does.
     *
     * @param string $body
     *
     * @return DeliveryQuoteResponse
     * @throws PicupApiException
     */
    public static function make(string $body) : DeliveryQuoteResponse
    {
        $decodedObject = json_decode($body, false);

        if ($decodedObject === null) {
            throw new PicupApiException('Cannot build DeliveryQuoteResponse - response does not contain valid JSON');
        }
        $quoteResponse = new DeliveryQuoteResponse();

        // default to valid
        $quoteResponse->setValid(true);

        // handle picup direct
        if ((int) $decodedObject->picup->valid !== 1) {
            $quoteResponse->setValid(false);
            $quoteResponse->setError($decodedObject->picup->error);
        }

        // if picup was valid - create service types
        if ($quoteResponse->isValid()) {
            foreach ($decodedObject->picup->service_types as $service_type) {
                $deliveryServiceType = new DeliveryServiceType();

                $deliveryServiceType->setDescription($service_type->description);
                $deliveryServiceType->setPriceInclusive($service_type->price_incl_vat);
                $deliveryServiceType->setPriceExclusive($service_type->price_ex_vat);
                $deliveryServiceType->setDuration($service_type->duration);
                $deliveryServiceType->setDistance($service_type->distance);

                $quoteResponse->addServiceType($deliveryServiceType);
            }
        }

        // handle third party
        if (isset($decodedObject->third_party) && !empty($decodedObject->third_party)) {
            $thirdPartyResponse = ThirdPartyResponseFactory::make($decodedObject->third_party);
            $quoteResponse->setThirdPartyResponse($thirdPartyResponse);
        }

        return $quoteResponse;
    }
}
