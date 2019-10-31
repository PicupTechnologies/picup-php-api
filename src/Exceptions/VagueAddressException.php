<?php

declare(strict_types=1);

namespace PicupTechnologies\PicupPHPApi\Exceptions;

/**
 * Exception thrown when an address request returns
 * too many possibilities.
 *
 * When an address is sent to Picup it is verified.
 *
 * If, during geocoding, multiple addresses are turned
 * then we throw this error so the consumer knows to
 * update the address.
 *
 * @package PicupTechnologies\PicupPHPApi\Exceptions
 */
final class VagueAddressException extends PicupApiException
{
}
