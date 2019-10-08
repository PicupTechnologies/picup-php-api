<?php

declare(strict_types=1);

namespace PicupTechnologies\PicupPHPApi\Tests\Requests;

use PHPUnit\Framework\TestCase;
use PicupTechnologies\PicupPHPApi\Requests\OrderStatusRequest;

class OrderStatusRequestTest extends TestCase
{
    public function testBasics() : void
    {
        $request = new OrderStatusRequest(['ref-555']);
        $this->assertSame(['ref-555'], $request->getCustomerReferences());

        $jsonEncoded = json_encode($request);
        $jsonDecoded = json_decode($jsonEncoded, true);

        $this->assertSame(['customer_references' => ['ref-555']], $jsonDecoded);
    }
}
