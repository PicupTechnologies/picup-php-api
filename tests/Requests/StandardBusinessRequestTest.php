<?php

declare(strict_types=1);

namespace PicupTechnologies\PicupPHPApi\Tests\Requests;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use PicupTechnologies\PicupPHPApi\Requests\StandardBusinessRequest;

class StandardBusinessRequestTest extends TestCase
{
    public function testBasics() : void
    {
        $request = new StandardBusinessRequest('business-1234');
        $this->assertSame('business-1234', $request->getBusinessId());

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Supplied businessId must begin with the business prefix');

        new StandardBusinessRequest('invalid-id');
    }
}
