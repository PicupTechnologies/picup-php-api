<?php

declare(strict_types=1);

namespace PicupTechnologies\PicupPHPApi\Tests\Responses;

use PHPUnit\Framework\TestCase;
use PicupTechnologies\PicupPHPApi\Responses\DeliveryOrderResponse;

class DeliveryOrderResponseTest extends TestCase
{
    public function testMake() : void
    {
        $deliveryOrderResponse = new DeliveryOrderResponse(555);

        $this->assertSame(555, $deliveryOrderResponse->getId());
    }
}
