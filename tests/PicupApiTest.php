<?php

namespace PicupTechnologies\PicupPHPApi\Tests;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use PicupTechnologies\PicupPHPApi\Exceptions\PicupApiException;
use PicupTechnologies\PicupPHPApi\Exceptions\QuoteRequestFailed;
use PicupTechnologies\PicupPHPApi\PicupApi;
use PicupTechnologies\PicupPHPApi\Tests\Fixtures\OrderRequestFixture;
use PicupTechnologies\PicupPHPApi\Tests\Fixtures\QuoteRequestFixture;
use function GuzzleHttp\Psr7\stream_for;

class PicupApiTest extends TestCase
{
    public function testBasics(): void
    {
        $mock = new MockHandler([new Response(200, [], json_encode([]))]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $apiKey = 'api-key-123-456';
        $picupApi = new PicupApi($client, $apiKey);

        $this->assertEquals($apiKey, $picupApi->getApiKey());

        $picupApi->setApiKey('api-changed-555');
        $this->assertEquals('api-changed-555', $picupApi->getApiKey());
    }

    /**
     * Test sending a quote request and building a quote response
     *
     * @throws PicupApiException
     */
    public function testSendQuoteRequest(): void
    {
        // 1 - Build Mock
        $data = [
            'picup' => [
                'valid' => 1,
                'service_types' => [
                    [
                        'description' => 'vehicle-space-ship',
                        'price_incl_vat' => 500,
                        'price_ex_vat' => 400,
                        'duration' => '24:00:00',
                        'distance' => '500'
                    ]
                ]
            ]
        ];

        $mock = new MockHandler([new Response(200, [], json_encode($data))]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        // 2 - Build Request
        $quoteRequestFixture = QuoteRequestFixture::make();

        // 3 - Send Test Request
        $picupApi = new PicupApi($client, 'api-123');
        $deliveryQuoteResponse = $picupApi->sendQuoteRequest($quoteRequestFixture);

        $this->assertEquals(true, $deliveryQuoteResponse->isValid());

        $serviceTypes = $deliveryQuoteResponse->getServiceTypes();
        $this->assertCount(1, $serviceTypes);

        $serviceType = $serviceTypes[0];
        $this->assertEquals('vehicle-space-ship', $serviceType->getDescription());
        $this->assertEquals(500, $serviceType->getPriceInclusive());
        $this->assertEquals(400, $serviceType->getPriceExclusive());
        $this->assertEquals('24:00:00', $serviceType->getDuration());
        $this->assertEquals(500, $serviceType->getDistance());
        $this->assertEquals('Space Ship', $serviceType->getVehicleName());
    }

    public function testSendQuoteRequestFailure(): void
    {
        $data = [
            'error' => 'houston. problem.'
        ];
        $mock = new MockHandler([new Response(500, [], json_encode($data))]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);
        $apiKey = 'api-555';

        $picupApi = new PicupApi($client, $apiKey);

        $quoteRequestFixture = QuoteRequestFixture::make();

        $this->expectException(PicupApiException::class);
        $this->expectExceptionMessage('QuoteRequest Error: {"error":"houston. problem."}');

        $picupApi->sendQuoteRequest($quoteRequestFixture);
    }

    /**
     * @throws PicupApiException
     */
    public function testSendOrderRequest(): void
    {
        // 1 - Build Mock
        $data = [
            'request_id' => 555
        ];

        $mock = new MockHandler([new Response(200, [], json_encode($data))]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        // 2 - Build Request
        $orderRequest = OrderRequestFixture::make();

        // 3 - Send Test Request
        $picupApi = new PicupApi($client, 'api-123');
        $response = $picupApi->sendOrderRequest($orderRequest);

        $this->assertEquals(555, $response->getId());
    }

    /**
     * @throws PicupApiException
     */
    public function testSendOrderRequestFailure(): void
    {
        // 1 - Build Mock
        $data = [
            'error' => 'houston. another problem.'
        ];

        $mock = new MockHandler([new Response(500, [], json_encode($data))]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        // 2 - Build Request
        $orderRequest = OrderRequestFixture::make();

        // 3 - Send Test Request
        $picupApi = new PicupApi($client, 'api-123');

        $this->expectException(PicupApiException::class);
        $this->expectExceptionMessage('OrderRequest Error: {"error":"houston. another problem."}');

        $picupApi->sendOrderRequest($orderRequest);
    }

    public function testSendDeliveryBucket(): void
    {
    }

    public function testSendIntegrationDetailsRequest(): void
    {
    }

    /**
     * @throws PicupApiException
     */
    public function testSendDispatchSummaryRequest(): void
    {
        $data = [];
        $mock = new MockHandler([new Response(200, [], json_encode($data))]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $picupApi = new PicupApi($client, 'api-123');

        $apiResponse = $picupApi->sendDispatchSummaryRequest('123-456');

        print_r($apiResponse);
    }
}
