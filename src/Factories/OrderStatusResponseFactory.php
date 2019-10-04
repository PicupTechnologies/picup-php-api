<?php

namespace PicupTechnologies\PicupPHPApi\Factories;

use PicupTechnologies\PicupPHPApi\Objects\OrderStatus;
use PicupTechnologies\PicupPHPApi\Responses\OrderStatusResponse;

final class OrderStatusResponseFactory
{
    public static function make($body): OrderStatusResponse
    {
        $orderStatuses = [];

        foreach ($body as $item) {
            // build parcels
            $parcelStatuses = ParcelStatusFactory::make($item['parcel_statuses']);

            $orderStatuses[] = new OrderStatus(
                $item['customer_reference'],
                $item['order_status'],
                $parcelStatuses
            );
        }

        return new OrderStatusResponse($orderStatuses);
    }
}
