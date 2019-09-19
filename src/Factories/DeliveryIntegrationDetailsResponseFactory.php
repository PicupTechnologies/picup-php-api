<?php

namespace PicupTechnologies\PicupPHPApi\Factories;

use PicupTechnologies\PicupPHPApi\Responses\DeliveryIntegrationDetailsResponse;
use PicupTechnologies\PicupPHPApi\Objects\Warehouses\DeliveryWarehouse;

final class DeliveryIntegrationDetailsResponseFactory
{
    public static function make(array $request): DeliveryIntegrationDetailsResponse
    {
        $keyValid = $request['is_key_valid'];
        $keyValidMessage = $request['is_key_valid_message'];
        $warehouses = [];

        if (!empty($request['warehouses'])) {
            foreach ($request['warehouses'] as $requestWarehouse) {
                $warehouse = new DeliveryWarehouse($requestWarehouse['warehouse_id'], $requestWarehouse['warehouse_name']);
                $warehouses[] = $warehouse;
            }
        }

        $response = new DeliveryIntegrationDetailsResponse(
            $keyValid,
            $keyValidMessage,
            $warehouses
        );

        return $response;
    }
}
