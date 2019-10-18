<?php

declare(strict_types=1);

namespace PicupTechnologies\PicupPHPApi\Factories;

use PicupTechnologies\PicupPHPApi\Exceptions\PicupApiException;
use PicupTechnologies\PicupPHPApi\Responses\DeliveryOrderResponse;

/**
 * Builds a DeliveryOrderResponse
 *
 * @package PicupTechnologies\PicupPHPApi\Factories
 */
final class DeliveryOrderResponseFactory
{
    /**
     * @param string $request
     *
     * @return DeliveryOrderResponse
     * @throws PicupApiException
     */
    public static function make(string $request) : DeliveryOrderResponse
    {
        $decoded = json_decode($request, false);

        if ($decoded === null) {
            throw new PicupApiException('Cannot build DeliveryOrderResponse - response does not contain valid JSON');
        }

        return new DeliveryOrderResponse($decoded->request_id);
    }
}
