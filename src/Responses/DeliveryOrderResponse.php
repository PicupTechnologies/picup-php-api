<?php

declare(strict_types=1);

namespace PicupTechnologies\PicupPHPApi\Responses;

/**
 * Holds the DeliveryOrder response from Picup after creating an order.
 *
 * @package PicupTechnologies\PicupPHPApi\Responses
 */
class DeliveryOrderResponse
{
    /**
     * @var int Picup Id
     */
    private $requestId;

    /**
     * DeliveryOrderResponse constructor.
     *
     * @param int $requestId
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
