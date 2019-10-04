<?php
/**
 * Created by PhpStorm.
 * User: bryan
 * Date: 2018/10/24
 * Time: 1:54 PM
 */

namespace PicupTechnologies\PicupPHPApi\Exceptions;

use PicupTechnologies\PicupPHPApi\Contracts\PicupRequestInterface;

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
     * @var PicupRequestInterface $picupRequest
     */
    private $picupRequest;

    /**
     * OrderRequestFailed constructor.
     *
     * @param PicupRequestInterface $picupRequest
     * @param string                $message
     * @param int                   $code
     */
    public function __construct(PicupRequestInterface $picupRequest, string $message, int $code = 0)
    {
        $this->picupRequest = $picupRequest;

        parent::__construct($message, $code);
    }

    /**
     * Returns the picup request that failed
     *
     * @return PicupRequestInterface
     */
    public function getPicupRequest(): PicupRequestInterface
    {
        return $this->picupRequest;
    }
}
