<?php

namespace PicupTechnologies\PicupPHPApi\Responses;

use PicupTechnologies\PicupPHPApi\Objects\OrderStatus;

final class OrderStatusResponse
{
    /**
     * @var OrderStatus[]
     */
    private $orderStatuses;

    /**
     * OrderStatusResponse constructor.
     *
     * @param OrderStatus[] $orderStatuses
     */
    public function __construct(array $orderStatuses)
    {
        $this->orderStatuses = $orderStatuses;
    }

    /**
     * @return OrderStatus[]
     */
    public function getOrderStatuses(): array
    {
        return $this->orderStatuses;
    }
}
