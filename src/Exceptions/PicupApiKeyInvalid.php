<?php

namespace PicupTechnologies\PicupPHPApi\Exceptions;

use Exception;

/**
 * Class PicupApiKeyInvalid
 *
 * @package PicupTechnologies\PicupPHPApi\Exceptions
 */
class PicupApiKeyInvalid extends Exception
{
    /**
     * PicupApiKeyInvalid constructor.
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
