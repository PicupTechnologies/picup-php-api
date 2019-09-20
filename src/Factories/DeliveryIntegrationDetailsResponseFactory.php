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

        $parcels = [];
        if (!empty($request['parcel_sizes'])) {
            foreach ($request['parcel_sizes'] as $responseParcel) {
                $parcel = ParcelFactory::make($responseParcel);
                $parcels[] = $parcel;
            }
        }

        $response = new DeliveryIntegrationDetailsResponse(
            $keyValid,
            $keyValidMessage,
            $warehouses,
            $parcels
        );

        return $response;
    }
}
