<?php

namespace PicupTechnologies\PicupPHPApi\Tests\Adapters;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\MockObject\MockObject;
use PicupTechnologies\PicupPHPApi\Adapters\PicupDeliveryAdapter;
use PHPUnit\Framework\TestCase;
use function GuzzleHttp\Psr7\stream_for;

class PicupDeliveryAdapterTest extends TestCase
{
    /**
     * @throws \Exception
     */
    public function testSendDispatchSummaryRequest(): void
    {
        /** @var Client|MockObject $httpClient */
        $httpClient = $this
            ->getMockBuilder(Client::class)
            ->setMethods(['get'])
            ->getMock()
        ;

        $businessId = '123-456';
        $endpoint = sprintf('https://otdcpt-knupqa.onthedot.co.za/picup-api/v1/integration/%s/dispatch-summary', $businessId);

        $responseStatus = 200;
        $responseHeaders = [];
        $responseBody = stream_for('{"data" : "test"}');

        $response = new Response($responseStatus, $responseHeaders, $responseBody);

        $httpClient
            ->expects($this->once())
            ->method('get')
            ->with($endpoint)
            ->willReturn($response)
        ;

        $deliveryAdapter = new PicupDeliveryAdapter($httpClient);

        $adapterResponse = $deliveryAdapter->sendDispatchSummaryRequest('123-456');

        $this->assertEquals('test', $adapterResponse['data']);
    }

    public function testSendQuoteRequest()
    {

    }

    public function testSendOrderRequest()
    {

    }

    public function testSendDeliveryBucket()
    {

    }

    public function testSendIntegrationDetailsRequest()
    {

    }
}
