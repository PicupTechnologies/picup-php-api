<?php

namespace PicupTechnologies\PicupPHPApi\Tests\Exceptions;

use PicupTechnologies\PicupPHPApi\Exceptions\PicupApiKeyInvalid;
use PHPUnit\Framework\TestCase;

class PicupApiKeyInvalidTest extends TestCase
{
    public function testException(): void
    {
        try {
            throw new PicupApiKeyInvalid('Key invalid');
        } catch (PicupApiKeyInvalid $e) {
            $this->assertContains('PicupApiKeyInvalid: [0]: Key invalid', (string)$e);
        }
    }
}
