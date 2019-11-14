<?php

namespace PicupTechnologies\PicupPHPApi\Factories;

use PicupTechnologies\PicupPHPApi\Objects\ThirdParty\WaybillDestination;
use PicupTechnologies\PicupPHPApi\Objects\ThirdParty\WaybillOrigin;

final class ThirdPartyWaybillAddressFactory
{
    /**
     * Factory function to create a WaybillOrigin
     *
     * Provide a WaybillOrigin or WaybillDestination and it will hyrdrate the specified
     * object
     *
     */
    public static function makeOrigin($decodedJsonObject): WaybillOrigin
    {
        $response = new WaybillOrigin();

        $response->setAddressLine1($decodedJsonObject->address_line_1);
        $response->setAddressLine2($decodedJsonObject->address_line_2);
        $response->setAddressLine3($decodedJsonObject->address_line_3);
        $response->setAddressLine4($decodedJsonObject->address_line_4);

        $response->setSuburb($decodedJsonObject->suburb);
        $response->setPostalCode($decodedJsonObject->postal_code);
        $response->setLatitude($decodedJsonObject->latitude);
        $response->setLongitude($decodedJsonObject->longitude);

        $response->setCustomerName($decodedJsonObject->customer_name);
        $response->setCustomerPhone($decodedJsonObject->customer_phone);
        $response->setCustomerEmail($decodedJsonObject->customer_email);

        $response->setSpecialInstructions($decodedJsonObject->special_instructions);

        return $response;
    }

    public static function makeDestination($decodedJsonObject): WaybillDestination
    {
        $response = new WaybillDestination();

        $response->setAddressLine1($decodedJsonObject->address_line_1);
        $response->setAddressLine2($decodedJsonObject->address_line_2);
        $response->setAddressLine3($decodedJsonObject->address_line_3);
        $response->setAddressLine4($decodedJsonObject->address_line_4);

        $response->setSuburb($decodedJsonObject->suburb);
        $response->setPostalCode($decodedJsonObject->postal_code);
        $response->setLatitude($decodedJsonObject->latitude);
        $response->setLongitude($decodedJsonObject->longitude);

        $response->setCustomerName($decodedJsonObject->customer_name);
        $response->setCustomerPhone($decodedJsonObject->customer_phone);
        $response->setCustomerEmail($decodedJsonObject->customer_email);

        $response->setSpecialInstructions($decodedJsonObject->special_instructions);

        return $response;
    }
}
