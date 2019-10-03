<?php
/**
 * Created by PhpStorm.
 * User: bryan
 * Date: 2018/10/24
 * Time: 1:54 PM
 */

namespace PicupTechnologies\PicupPHPApi\Exceptions;

use Exception;
use PicupTechnologies\PicupPHPApi\Requests\DeliveryQuoteRequest;

/**
 * Exception thrown when a Quote Request fails
 *
 * @package PicupTechnologies\PicupPHPApi\Exceptions
 */
class QuoteRequestFailed extends Exception
{
    /**
     * @var DeliveryQuoteRequest The quote request that failed
     */
    private $deliveryQuoteRequest;

    /**
     * QuoteRequestFailed constructor.
     *
     * @param DeliveryQuoteRequest $deliveryQuoteRequest
     * @param string               $message
     * @param int                  $code
     */
    public function __construct(DeliveryQuoteRequest $deliveryQuoteRequest, string $message, int $code = 0)
    {
        $this->deliveryQuoteRequest = $deliveryQuoteRequest;

        parent::__construct($message, $code);
    }

    public function __toString()
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }

    /**
     * Returns the Delivery Quote Request that failed
     *
     * @return DeliveryQuoteRequest
     */
    public function getDeliveryQuoteRequest(): DeliveryQuoteRequest
    {
        return $this->deliveryQuoteRequest;
    }
}
