<?php
/**
 * Created by PhpStorm.
 * User: bryan
 * Date: 2018/10/24
 * Time: 1:54 PM
 */

namespace PicupTechnologies\PicupPHPApi\Exceptions;

use Exception;
use PicupTechnologies\PicupPHPApi\Contracts\PicupRequest;
use PicupTechnologies\PicupPHPApi\Requests\DeliveryOrderRequest;

/**
 * Exception that is thrown when an Order Request fails
 *
 * @package PicupTechnologies\PicupPHPApi\Exceptions
 */
class PicupRequestFailed extends PicupApiException
{
    /**
     * Stores the picup request that we attempted to send
     *
     * @var PicupRequest $picupRequest
     */
    private $picupRequest;

    /**
     * OrderRequestFailed constructor.
     *
     * @param PicupRequest $picupRequest
     * @param string       $message
     * @param int          $code
     */
    public function __construct(PicupRequest $picupRequest, string $message, int $code = 0)
    {
        $this->picupRequest = $picupRequest;

        parent::__construct($message, $code);
    }

    /**
     * Returns the picup request that failed
     *
     * @return PicupRequest
     */
    public function getPicupRequest(): PicupRequest
    {
        return $this->picupRequest;
    }
}
