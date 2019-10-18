<?php

declare(strict_types=1);

namespace PicupTechnologies\PicupPHPApi\Factories;

use PicupTechnologies\PicupPHPApi\Objects\OrderStatus;
use PicupTechnologies\PicupPHPApi\Responses\OrderStatusResponse;

/**
 * Builds an OrderStatusResponse
 *
 * @package PicupTechnologies\PicupPHPApi\Factories
 */
final class OrderStatusResponseFactory
{
    /**
     * @param array $body
     *
     * @return OrderStatusResponse
     */
    public static function make(array $body) : OrderStatusResponse
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
