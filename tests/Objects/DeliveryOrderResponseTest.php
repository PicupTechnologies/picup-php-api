<?php

namespace PicupTechnologies\PicupPHPApi\Tests\Objects;

use PHPUnit\Framework\TestCase;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryOrderResponse;

class DeliveryOrderResponseTest extends TestCase
{
    public function testMake(): void
    {
        $deliveryOrderResponse = new DeliveryOrderResponse(555);

        $this->assertEquals(555, $deliveryOrderResponse->getId());
    }
}
