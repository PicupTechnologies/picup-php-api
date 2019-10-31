<?php

declare(strict_types=1);


namespace PicupTechnologies\PicupPHPApi\Exceptions;

use PicupTechnologies\PicupPHPApi\Contracts\PicupRequestInterface;

/**
 * Exception that is thrown when an Order Request fails
 *
 * The request that failed can be obtained by calling $e->getPicupRequest()
 */
class PicupRequestFailed extends PicupApiException
{
    /**
     * Stores the picup request that we attempted to send
     *
     * @var PicupRequestInterface
     */
    protected $picupRequest;

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
     */
    public function getPicupRequest() : PicupRequestInterface
    {
        return $this->picupRequest;
    }
}
