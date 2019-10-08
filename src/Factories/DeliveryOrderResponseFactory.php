<?php

declare(strict_types=1);

namespace PicupTechnologies\PicupPHPApi\Factories;

use PicupTechnologies\PicupPHPApi\Responses\DeliveryOrderResponse;

/**
 * Builds a DeliveryOrderResponse
 */
final class DeliveryOrderResponseFactory
{
    public static function make(string $request) : DeliveryOrderResponse
    {
        $decoded = json_decode($request, false);

        return new DeliveryOrderResponse($decoded->request_id);
    }
}
