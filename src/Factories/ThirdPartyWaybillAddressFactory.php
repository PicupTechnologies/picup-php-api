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

        if ($decodedJsonObject->address_line_2) {
            $response->setAddressLine2($decodedJsonObject->address_line_2);
        }

        if ($decodedJsonObject->address_line_3) {
            $response->setAddressLine3($decodedJsonObject->address_line_3);
        }

        if ($decodedJsonObject->address_line_4) {
            $response->setAddressLine4($decodedJsonObject->address_line_4);
        }

        if ($decodedJsonObject->suburb) {
            $response->setSuburb($decodedJsonObject->suburb);
        }

        if ($decodedJsonObject->postal_code) {
            $response->setPostalCode($decodedJsonObject->postal_code);
        }

        if ($decodedJsonObject->latitude) {
            $response->setLatitude($decodedJsonObject->latitude);
        }
        if ($decodedJsonObject->longitude) {
            $response->setLongitude($decodedJsonObject->longitude);
        }

        if ($decodedJsonObject->customer_name) {
            $response->setCustomerName($decodedJsonObject->customer_name);
        }

        if ($decodedJsonObject->customer_phone) {
            $response->setCustomerPhone($decodedJsonObject->customer_phone);
        }

        if ($decodedJsonObject->customer_email) {
            $response->setCustomerEmail($decodedJsonObject->customer_email);
        }

        if ($decodedJsonObject->special_instructions) {
            $response->setSpecialInstructions($decodedJsonObject->special_instructions);
        }

        return $response;
    }

    public static function makeDestination($decodedJsonObject): WaybillDestination
    {
        $response = new WaybillDestination();

        $response->setAddressLine1($decodedJsonObject->address_line_1);
        
        if ($decodedJsonObject->address_line_2) {
            $response->setAddressLine2($decodedJsonObject->address_line_2);
        }

        if ($decodedJsonObject->address_line_3) {
            $response->setAddressLine3($decodedJsonObject->address_line_3);
        }

        if ($decodedJsonObject->address_line_4) {
            $response->setAddressLine4($decodedJsonObject->address_line_4);
        }

        if ($decodedJsonObject->suburb) {
            $response->setSuburb($decodedJsonObject->suburb);
        }

        if ($decodedJsonObject->postal_code) {
            $response->setPostalCode($decodedJsonObject->postal_code);
        }

        if ($decodedJsonObject->latitude) {
            $response->setLatitude($decodedJsonObject->latitude);
        }
        if ($decodedJsonObject->longitude) {
            $response->setLongitude($decodedJsonObject->longitude);
        }

        if ($decodedJsonObject->customer_name) {
            $response->setCustomerName($decodedJsonObject->customer_name);
        }

        if ($decodedJsonObject->customer_phone) {
            $response->setCustomerPhone($decodedJsonObject->customer_phone);
        }

        if ($decodedJsonObject->customer_email) {
            $response->setCustomerEmail($decodedJsonObject->customer_email);
        }

        if ($decodedJsonObject->special_instructions) {
            $response->setSpecialInstructions($decodedJsonObject->special_instructions);
        }

        return $response;
    }
}
