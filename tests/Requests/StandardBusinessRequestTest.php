<?php

namespace PicupTechnologies\PicupPHPApi\Tests\Requests;

use InvalidArgumentException;
use PicupTechnologies\PicupPHPApi\Requests\StandardBusinessRequest;
use PHPUnit\Framework\TestCase;

class StandardBusinessRequestTest extends TestCase
{
    public function testBasics(): void
    {
        $request = new StandardBusinessRequest('business-1234');
        $this->assertEquals('business-1234', $request->getBusinessId());

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Supplied businessId must begin with the business prefix');

        new StandardBusinessRequest('invalid-id');
    }
}
