<?php

declare(strict_types=1);

namespace PicupTechnologies\PicupPHPApi\Tests\Exceptions;

use PHPUnit\Framework\TestCase;
use PicupTechnologies\PicupPHPApi\Exceptions\PicupRequestFailed;
use PicupTechnologies\PicupPHPApi\Requests\DeliveryOrderRequest;

class PicupRequestFailedTest extends TestCase
{
    public function testException() : void
    {
        $orderRequest = new DeliveryOrderRequest();
        $orderRequest->setMerchantId('merchant-999');

        try {
            throw new PicupRequestFailed($orderRequest, 'Order Request Failed');
        } catch (PicupRequestFailed $e) {
            $this->assertContains('PicupRequestFailed: Order Request Failed', (string) $e);

            $this->assertSame($orderRequest, $e->getPicupRequest());
        }
    }
}
