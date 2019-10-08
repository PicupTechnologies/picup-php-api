<?php

declare(strict_types=1);


namespace PicupTechnologies\PicupPHPApi\Exceptions;

use PicupTechnologies\PicupPHPApi\Contracts\PicupRequestInterface;

/**
 * Exception that is thrown when an Order Request fails
 */
class PicupRequestFailed extends PicupApiException
{
    /**
     * Stores the picup request that we attempted to send
     *
     * @var PicupRequestInterface
     */
    private $picupRequest;

    /**
     * OrderRequestFailed constructor.
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
