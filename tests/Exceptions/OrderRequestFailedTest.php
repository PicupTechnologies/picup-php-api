<?php

namespace PicupTechnologies\PicupPHPApi\Tests\Exceptions;

use PicupTechnologies\PicupPHPApi\Exceptions\OrderRequestFailed;
use PHPUnit\Framework\TestCase;
use PicupTechnologies\PicupPHPApi\Requests\DeliveryOrderRequest;

class OrderRequestFailedTest extends TestCase
{
    public function testException(): void
    {
        $orderRequest = new DeliveryOrderRequest();
        $orderRequest->setMerchantId('merchant-999');

        try {
            throw new OrderRequestFailed($orderRequest, 'Order Request Failed');
        } catch (OrderRequestFailed $e) {
            $this->assertContains('OrderRequestFailed: [0]: Order Request Failed', (string)$e);

            $this->assertEquals($orderRequest, $e->getDeliveryOrderRequest());
        }
    }
}
