<?php

declare(strict_types=1);

namespace PicupTechnologies\PicupPHPApi\Factories;

use PicupTechnologies\PicupPHPApi\Exceptions\PicupApiException;
use PicupTechnologies\PicupPHPApi\Responses\DeliveryBucketResponse;

/**
 * Builds a DeliveryBucketResponse from the raw data
 * returned by Picup Enterprise
 *
 * @package PicupTechnologies\PicupPHPApi\Factories
 */
final class DeliveryBucketResponseFactory
{
    /**
     * @param string $request
     *
     * @return DeliveryBucketResponse
     * @throws PicupApiException
     */
    public static function make(string $request) : DeliveryBucketResponse
    {
        $decoded = json_decode($request, true);

        if ($decoded === null) {
            throw new PicupApiException('Cannot build DeliveryBucketResponse - response does not contain valid JSON');
        }

        return new DeliveryBucketResponse($decoded[0]);
    }
}
