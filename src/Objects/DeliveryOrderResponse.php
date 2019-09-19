<?php
/**
 * Created by PhpStorm.
 * User: bryan
 * Date: 2018/10/23
 * Time: 2:59 PM
 */

namespace PicupTechnologies\PicupPHPApi\Objects;

class DeliveryOrderResponse
{
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

    public function getId(): ?int
    {
        return $this->requestId;
    }
}
