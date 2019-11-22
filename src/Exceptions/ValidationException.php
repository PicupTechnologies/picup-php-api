<?php

declare(strict_types=1);

namespace PicupTechnologies\PicupPHPApi\Exceptions;

use InvalidArgumentException;
use PicupTechnologies\PicupPHPApi\Contracts\PicupRequestInterface;

/**
 * Exception thrown when there is a validation error
 * in the request.
 *
 * This will only occur after we send a request that failed
 * so we extend PicupRequestFailed providing us with a
 * $exception->getPicupRequest(); to return the request
 * that failed.
 *
 * @package PicupTechnologies\PicupPHPApi\Exceptions
 */
final class ValidationException extends PicupRequestFailed
{
    private $validationErrors = [];

    /**
     * OrderRequestFailed constructor.
     *
     * @param PicupRequestInterface $picupRequest
     * @param string                $message
     * @param array                 $validationErrors
     * @param int                   $code
     *
     * @throws VagueAddressException
     */
    public function __construct(PicupRequestInterface $picupRequest, string $message, array $validationErrors, int $code = 0)
    {
        // first call our parent which gives the consumer access to the
        // request that failed via $exception->getPicupRequest();

        parent::__construct($picupRequest, $message, $code);

        $this->validationErrors = $validationErrors;

        // now we need to parse the validation errors from picup
        // and throw the relevant exceptions
        $this->parseValidationErrors($validationErrors);
    }

    /**
     * @param array $validationErrors
     *
     * @throws VagueAddressException
     */
    private function parseValidationErrors(array $validationErrors): void
    {
        foreach ($validationErrors as $validationError) {
            if (in_array('Probability of a match is too low', $validationError['errors'], false)) {
                throw new VagueAddressException('The address provided has returned multiple results. Please enter a more specific address.');
            }
        }
    }

    /**
     * @return array
     */
    public function getValidationErrors(): array
    {
        return $this->validationErrors;
    }
}
