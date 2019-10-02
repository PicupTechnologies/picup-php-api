<?php

namespace PicupTechnologies\PicupPHPApi\Factories;

use PicupTechnologies\PicupPHPApi\Responses\DispatchSummaryResponse;

final class DispatchSummaryResponseFactory
{
    public static function make(array $data): DispatchSummaryResponse
    {
        $response = new DispatchSummaryResponse(
            $data['picup_count'],
            $data['total_parcels'],
            $data['pending_parcels'],
            $data['failed_parcels'],
            $data['completed_parcels'],
            DispatchSummaryParcelFactory::make($data['parcels'])
        );

        return $response;
    }
}
