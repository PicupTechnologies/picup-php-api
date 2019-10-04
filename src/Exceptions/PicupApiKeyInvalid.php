<?php

namespace PicupTechnologies\PicupPHPApi\Exceptions;

use Exception;

/**
 * Exception thrown if the API Key used is invalid
 *
 * @package PicupTechnologies\PicupPHPApi\Exceptions
 */
class PicupApiKeyInvalid extends PicupApiException
{
    public function __toString(): string
    {
        return __CLASS__ . ": [Picup Api Key invalid]: {$this->message}\n";
    }
}
