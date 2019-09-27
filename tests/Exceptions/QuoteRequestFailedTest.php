<?php

namespace PicupTechnologies\PicupPHPApi\Tests\Exceptions;

use PicupTechnologies\PicupPHPApi\Exceptions\QuoteRequestFailed;
use PHPUnit\Framework\TestCase;
use PicupTechnologies\PicupPHPApi\Requests\DeliveryQuoteRequest;

class QuoteRequestFailedTest extends TestCase
{
    public function testException(): void
    {
        $quoteRequest = new DeliveryQuoteRequest();
        $quoteRequest->setMerchantId('merchant-54321');

        try {
            throw new QuoteRequestFailed($quoteRequest, 'Purple Sandwiches are bad');
        } catch (QuoteRequestFailed $e) {
            $this->assertContains('QuoteRequestFailed: [0]: Purple Sandwiches are bad', (string)$e);

            $this->assertEquals($quoteRequest, $e->getDeliveryQuoteRequest());
        }
    }
}
