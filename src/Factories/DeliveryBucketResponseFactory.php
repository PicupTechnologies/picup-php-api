<?php

declare(strict_types=1);

namespace PicupTechnologies\PicupPHPApi\Factories;

use PicupTechnologies\PicupPHPApi\Responses\DeliveryBucketResponse;

/**
 * Builds a DeliveryBucketResponse from the raw data
 * returned by Picup Enterprise
 */
final class DeliveryBucketResponseFactory
{
    public static function make(string $request) : DeliveryBucketResponse
    {
        $decoded = json_decode($request, true);

        return new DeliveryBucketResponse($decoded[0]);
    }
}
