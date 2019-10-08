<?php

declare(strict_types=1);

namespace PicupTechnologies\PicupPHPApi\Tests\Exceptions;

use PHPUnit\Framework\TestCase;
use PicupTechnologies\PicupPHPApi\Exceptions\PicupApiKeyInvalid;

class PicupApiKeyInvalidTest extends TestCase
{
    public function testException() : void
    {
        try {
            throw new PicupApiKeyInvalid('Key invalid');
        } catch (PicupApiKeyInvalid $e) {
            $this->assertContains('PicupApiKeyInvalid: Key invalid', (string) $e);
        }
    }
}
