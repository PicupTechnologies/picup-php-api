<?php

declare(strict_types=1);

namespace PicupTechnologies\PicupPHPApi\Tests\Exceptions;

use PHPUnit\Framework\TestCase;
use PicupTechnologies\PicupPHPApi\Exceptions\PicupApiException;

class PicupApiExceptionTest extends TestCase
{
    public function testExceptionToString() : void
    {
        try {
            throw new PicupApiException('Hello World');
        } catch (PicupApiException $e) {
            $this->assertContains('PicupApiException: Hello World', (string) $e);
        }
    }
}
