<?php

namespace PicupTechnologies\PicupPHPApi\Tests\Exceptions;

use PicupTechnologies\PicupPHPApi\Exceptions\PicupApiException;
use PHPUnit\Framework\TestCase;

class PicupApiExceptionTest extends TestCase
{
    public function testExceptionToString(): void
    {
        try {
            throw new PicupApiException('Hello World');
        } catch (PicupApiException $e) {
            $this->assertContains('PicupApiException: Hello World', (string)$e);
        }
    }
}
