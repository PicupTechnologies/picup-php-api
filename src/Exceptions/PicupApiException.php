<?php

namespace PicupTechnologies\PicupPHPApi\Exceptions;

use Exception;

/**
 * General exception thrown for the Picup API Responses
 *
 * @package PicupTechnologies\PicupPHPApi\Exceptions
 */
class PicupApiException extends Exception
{
    /**
     * PicupApiException constructor.
     *
     * @param string         $message
     * @param int            $code
     * @param Exception|null $previous
     */
    public function __construct(string $message, int $code = 0, Exception $previous = null)
    {
        // make sure everything is assigned properly
        parent::__construct($message, $code, $previous);
    }

    public function __toString(): string
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}
