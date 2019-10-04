<?php

namespace PicupTechnologies\PicupPHPApi\Tests\Requests;

use PicupTechnologies\PicupPHPApi\Requests\OrderStatusRequest;
use PHPUnit\Framework\TestCase;

class OrderStatusRequestTest extends TestCase
{
    public function testBasics(): void
    {
        $request = new OrderStatusRequest(['ref-555']);
        $this->assertEquals(['ref-555'], $request->getCustomerReferences());

        $jsonEncoded = json_encode($request);
        $jsonDecoded = json_decode($jsonEncoded, true);

        $this->assertEquals(['customer_references' => ['ref-555']], $jsonDecoded);
    }
}
