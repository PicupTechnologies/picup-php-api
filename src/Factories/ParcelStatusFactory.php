<?php

namespace PicupTechnologies\PicupPHPApi\Factories;

use PicupTechnologies\PicupPHPApi\Objects\ParcelStatus;

final class ParcelStatusFactory
{
    public static function make($body): array
    {
        $statuses = [];
        foreach ($body as $item) {
            $statuses[] = new ParcelStatus(
                $item['reference'],
                $item['status'],
                $item['tracking_number']
            );
        }

        return $statuses;
    }
}
