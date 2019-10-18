<?php

declare(strict_types=1);

namespace PicupTechnologies\PicupPHPApi\Factories;

use PicupTechnologies\PicupPHPApi\Responses\DispatchSummaryResponse;

/**
 * Builds a DispatchSummaryResponse
 *
 * @package PicupTechnologies\PicupPHPApi\Factories
 */
final class DispatchSummaryResponseFactory
{
    public static function make(array $data) : DispatchSummaryResponse
    {
        return new DispatchSummaryResponse(
            $data['picup_count'],
            $data['total_parcels'],
            $data['pending_parcels'],
            $data['failed_parcels'],
            $data['completed_parcels'],
            DispatchSummaryParcelFactory::make($data['parcels'])
        );
    }
}
