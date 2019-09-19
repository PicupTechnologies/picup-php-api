<?php

namespace PicupTechnologies\PicupPHPApi\Exceptions;

use Exception;

class PicupApiException extends Exception
{
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
