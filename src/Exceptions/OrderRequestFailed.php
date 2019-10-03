<?php
/**
 * Created by PhpStorm.
 * User: bryan
 * Date: 2018/10/24
 * Time: 1:54 PM
 */

namespace PicupTechnologies\PicupPHPApi\Exceptions;

use Exception;
use PicupTechnologies\PicupPHPApi\Requests\DeliveryOrderRequest;

/**
 * Exception that is thrown when an Order Request fails
 *
 * @package PicupTechnologies\PicupPHPApi\Exceptions
 */
class OrderRequestFailed extends Exception
{
    /**
     * @var DeliveryOrderRequest The order request that failed
     */
    private $deliveryOrderRequest;

    /**
     * OrderRequestFailed constructor.
     *
     * @param DeliveryOrderRequest $deliveryOrderRequest
     * @param string               $message
     * @param int                  $code
     */
    public function __construct(DeliveryOrderRequest $deliveryOrderRequest, string $message, int $code = 0)
    {
        $this->deliveryOrderRequest = $deliveryOrderRequest;

        parent::__construct($message, $code);
    }

    public function __toString(): string
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }

    /**
     * Returns the order request that failed
     *
     * @return DeliveryOrderRequest
     */
    public function getDeliveryOrderRequest(): DeliveryOrderRequest
    {
        return $this->deliveryOrderRequest;
    }
}
