<?php

declare(strict_types=1);

namespace PicupTechnologies\PicupPHPApi\Factories;

use PicupTechnologies\PicupPHPApi\Objects\ParcelStatus;

/**
 * Builds a ParcelStatus object for use within an OrderStatusResponse
 *
 * @package PicupTechnologies\PicupPHPApi\Factories
 */
final class ParcelStatusFactory
{
    /**
     * @param array $body
     *
     * @return ParcelStatus[]
     */
    public static function make(array $body) : array
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
