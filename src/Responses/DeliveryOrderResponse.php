<?php

declare(strict_types=1);


namespace PicupTechnologies\PicupPHPApi\Responses;

/**
 * Holds the DeliveryOrder response from Picup after creating an order.
 */
class DeliveryOrderResponse
{
    private $requestId;

    /**
     * DeliveryOrderResponse constructor.
     */
    public function __construct(int $requestId)
    {
        $this->requestId = $requestId;
    }

    public function getId() : ?int
    {
        return $this->requestId;
    }
}
