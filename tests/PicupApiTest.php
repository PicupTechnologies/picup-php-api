<?php

namespace PicupTechnologies\PicupPHPApi\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use PicupTechnologies\PicupPHPApi\Exceptions\PicupApiException;
use PicupTechnologies\PicupPHPApi\Exceptions\PicupApiKeyInvalid;
use PicupTechnologies\PicupPHPApi\Exceptions\PicupRequestFailed;
use PicupTechnologies\PicupPHPApi\PicupApi;
use PicupTechnologies\PicupPHPApi\Requests\StandardBusinessRequest;
use PicupTechnologies\PicupPHPApi\Tests\Fixtures\DeliveryBucketRequestFixture;
use PicupTechnologies\PicupPHPApi\Tests\Fixtures\OrderRequestFixture;
use PicupTechnologies\PicupPHPApi\Tests\Fixtures\QuoteRequestFixture;

class PicupApiTest extends TestCase
{
    public function testBasics(): void
    {
        $mock = new MockHandler([new Response(200, [], json_encode([]))]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        // api key getters + setters
        $apiKey = 'api-key-123-456';
        $picupApi = new PicupApi($client, $apiKey);

        $this->assertEquals($apiKey, $picupApi->getApiKey());

        $picupApi->setApiKey('api-changed-555');
        $this->assertEquals('api-changed-555', $picupApi->getApiKey());

        // live mode
        $this->assertFalse($picupApi->isLive());    // should default to false
        $picupApi->setLive();
        $this->assertTrue($picupApi->isLive());

        $picupApi->setTesting();
        $this->assertFalse($picupApi->isLive());
    }

    /**
     * Ensures that endpoints match live/testing mode
     */
    public function testEndpointsMatchLiveTestingMode(): void
    {
        $mock = new MockHandler([new Response(200, [], json_encode([]))]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        // api key getters + setters
        $apiKey = 'api-key-123-456';
        $picupApi = new PicupApi($client, $apiKey);
        $this->assertEquals($apiKey, $picupApi->getApiKey());

        // set to TESTING MODE
        $picupApi->setTesting();
        $prefix = $picupApi->getApiPrefix();
        $this->assertContains('knupqa', $prefix);

        // set to LIVE MODE
        $picupApi->setLive();
        $prefix = $picupApi->getApiPrefix();
        $this->assertContains('knupprd', $prefix);
    }

    /**
     * @throws PicupApiException
     * @throws PicupApiKeyInvalid
     * @throws PicupRequestFailed
     */
    public function testApiKeyIsMalformed(): void
    {
        $data = [
            'message' => 'Identity is invalid'
        ];
        $mock = new MockHandler([new Response(401, [], json_encode($data))]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $apiKey = 'api-key-123-456';
        $picupApi = new PicupApi($client, $apiKey);
        $this->assertEquals($apiKey, $picupApi->getApiKey());

        $businessRequest = new StandardBusinessRequest('malformed-uuid');

        $this->expectException(PicupApiKeyInvalid::class);
        $picupApi->sendIntegrationDetailsRequest($businessRequest);
    }

    /**
     * @throws PicupApiException
     * @throws PicupApiKeyInvalid
     * @throws PicupRequestFailed
     */
    public function testApiKeyIsIncorrect(): void
    {
        $data = [
            'message' => 'Authorization has been denied'
        ];
        $mock = new MockHandler([new Response(401, [], json_encode($data))]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $apiKey = 'api-key-123-456';
        $picupApi = new PicupApi($client, $apiKey);
        $this->assertEquals($apiKey, $picupApi->getApiKey());

        $businessRequest = new StandardBusinessRequest('valid-uuid-but-auth-denied');

        $this->expectException(PicupApiKeyInvalid::class);
        $picupApi->sendIntegrationDetailsRequest($businessRequest);
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

        $container = [];
        $history = Middleware::history($container);
        $mock = new MockHandler([new Response(200, [], json_encode($data))]);
        $handler = HandlerStack::create($mock);
        $handler->push($history);
        $client = new Client(['handler' => $handler]);

        // 2 - Build Request
        $quoteRequestFixture = QuoteRequestFixture::make();

        // 3 - Send Test Request
        $picupApi = new PicupApi($client, 'api-123');
        $deliveryQuoteResponse = $picupApi->sendQuoteRequest($quoteRequestFixture);

        // ASSERT REQUEST WAS CORRECT

        /** @var Request $sentRequest */
        $sentRequest = $container[0]['request'];

        // Ensure the correct url was used
        $this->assertEquals('https', $sentRequest->getUri()->getScheme());
        $this->assertEquals('otdcpt-knupqa.onthedot.co.za', $sentRequest->getUri()->getHost());
        $this->assertEquals('/picup-api/v1/integration/quote/one-to-many', $sentRequest->getUri()->getPath());

        // Ensure the api key was added to header
        $this->assertEquals('api-123', $sentRequest->getHeaderLine('api-key'));

        // Ensure the json was sent as expected
        $expectedData = json_encode($quoteRequestFixture);
        $sentData = $sentRequest->getBody()->getContents();
        $this->assertEquals($expectedData, $sentData);

        // ASSERT RETURNED OBJECT IS CORRECT

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

    /**
     * @throws PicupApiException
     */
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

        $container = [];
        $history = Middleware::history($container);
        $mock = new MockHandler([new Response(200, [], json_encode($data))]);
        $handler = HandlerStack::create($mock);
        $handler->push($history);
        $client = new Client(['handler' => $handler]);

        // 2 - Build Request
        $orderRequest = OrderRequestFixture::make();

        // 3 - Send Test Request
        $picupApi = new PicupApi($client, 'api-123');
        $response = $picupApi->sendOrderRequest($orderRequest);

        // ASSERT REQUEST WAS CORRECT

        /** @var Request $sentRequest */
        $sentRequest = $container[0]['request'];

        // Ensure the correct url was used
        $this->assertEquals('https', $sentRequest->getUri()->getScheme());
        $this->assertEquals('otdcpt-knupqa.onthedot.co.za', $sentRequest->getUri()->getHost());
        $this->assertEquals('/picup-api/v1/integration/create/one-to-many', $sentRequest->getUri()->getPath());

        // Ensure the api key was added to header
        $this->assertEquals('api-123', $sentRequest->getHeaderLine('api-key'));

        // Ensure the json was sent as expected
        $expectedData = json_encode($orderRequest);
        $sentData = $sentRequest->getBody()->getContents();
        $this->assertEquals($expectedData, $sentData);

        // ASSERT RETURNED OBJECT IS CORRECT

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

    /**
     * @throws PicupApiException
     */
    public function testSendDeliveryBucket(): void
    {
        // 1 - Build Mock
        $data = [
            'request_id' => 666
        ];

        $container = [];
        $history = Middleware::history($container);
        $mock = new MockHandler([new Response(200, [], json_encode($data))]);
        $handler = HandlerStack::create($mock);
        $handler->push($history);
        $client = new Client(['handler' => $handler]);

        // 2 - Build Request
        $request = DeliveryBucketRequestFixture::make();

        // 3 - Send Test Request
        $picupApi = new PicupApi($client, 'api-123');
        $response = $picupApi->sendDeliveryBucket($request);

        // ASSERT REQUEST WAS CORRECT

        /** @var Request $sentRequest */
        $sentRequest = $container[0]['request'];

        // Ensure the correct url was used
        $this->assertEquals('https', $sentRequest->getUri()->getScheme());
        $this->assertEquals('otdcpt-knupqa.onthedot.co.za', $sentRequest->getUri()->getHost());
        $this->assertEquals('/picup-api/v1/integration/add-to-bucket', $sentRequest->getUri()->getPath());

        // Ensure the api key was added to header
        $this->assertEquals('api-123', $sentRequest->getHeaderLine('api-key'));

        // Ensure the json was sent as expected
        $expectedData = json_encode($request);
        $sentData = $sentRequest->getBody()->getContents();
        $this->assertEquals($expectedData, $sentData);

        // ASSERT RETURNED OBJECT IS CORRECT

        $this->assertEquals(666, $response->getId());
    }

    /**
     * @throws PicupApiException
     */
    public function testSendDeliveryBucketFailure(): void
    {
        // 1 - Build Mock
        $data = [
            'error' => 'houston. another problem.'
        ];

        $mock = new MockHandler([new Response(500, [], json_encode($data))]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        // 2 - Build Request
        $request = DeliveryBucketRequestFixture::make();

        // 3 - Send Test Request
        $picupApi = new PicupApi($client, 'api-123');

        $this->expectException(PicupApiException::class);
        $this->expectExceptionMessage('DeliveryBucket Error: {"error":"houston. another problem."}');

        $picupApi->sendDeliveryBucket($request);
    }

    /**
     * @throws PicupApiException
     * @throws PicupApiKeyInvalid
     */
    public function testSendIntegrationDetailsRequestWithValidApiKey(): void
    {
        $data = [
            'is_key_valid' => true,
            'is_key_valid_message' => 'Your key is valid',
            'warehouses' => [
                [
                    'warehouse_id' => 'warehouse-123', 'warehouse_name' => 'Test Warehouse'
                ]
            ]
        ];

        $container = [];
        $history = Middleware::history($container);
        $mock = new MockHandler([new Response(200, [], json_encode($data))]);
        $handler = HandlerStack::create($mock);
        $handler->push($history);
        $client = new Client(['handler' => $handler]);

        $picupApi = new PicupApi($client, 'api-123');

        $request = new StandardBusinessRequest('123-456');
        $apiResponse = $picupApi->sendIntegrationDetailsRequest($request);

        // ASSERT REQUEST WAS CORRECT

        /** @var Request $sentRequest */
        $sentRequest = $container[0]['request'];

        // Ensure the correct url was used
        $this->assertEquals('https', $sentRequest->getUri()->getScheme());
        $this->assertEquals('otdcpt-knupqa.onthedot.co.za', $sentRequest->getUri()->getHost());
        $this->assertEquals('/picup-api/v1/integration/123-456/details', $sentRequest->getUri()->getPath());

        // ASSERT RETURNED OBJECT IS CORRECT

        $this->assertTrue($apiResponse->isKeyValid());
        $this->assertEquals('Your key is valid', $apiResponse->getIsKeyValidMessage());

        $warehouses = $apiResponse->getWarehouses();
        $this->assertCount(1, $warehouses);

        $warehouse = $warehouses[0];
        $this->assertEquals('warehouse-123', $warehouse->getId());
        $this->assertEquals('Test Warehouse', $warehouse->getName());
    }

    /**
     * @throws PicupApiException
     * @throws PicupApiKeyInvalid
     */
    public function testSendIntegrationDetailsRequestWithInvalidApiKey(): void
    {
        $data = [
            'is_key_valid' => false,
            'is_key_valid_message' => 'Your key is invalid',
            'warehouses' => []
        ];
        $mock = new MockHandler([new Response(200, [], json_encode($data))]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $picupApi = new PicupApi($client, 'api-123');

        $this->expectException(PicupApiKeyInvalid::class);

        $request = new StandardBusinessRequest('123-456');
        $picupApi->sendIntegrationDetailsRequest($request);
    }

    /**
     * @throws PicupApiException
     * @throws PicupApiKeyInvalid
     */
    public function testSendIntegrationDetailsRequestWithInvalidIdentity(): void
    {
        $data = [
            'Message' => 'Identity is invalid'
        ];
        $mock = new MockHandler([new Response(500, [], json_encode($data))]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $picupApi = new PicupApi($client, 'api-123');

        $this->expectException(PicupApiKeyInvalid::class);

        $request = new StandardBusinessRequest('123-456');
        $picupApi->sendIntegrationDetailsRequest($request);
    }

    /**
     * @throws PicupApiException
     * @throws PicupApiKeyInvalid
     */
    public function testSendIntegrationDetailsRequestWithInvalidResponse(): void
    {
        $data = [
            'Message' => 'something else broke'
        ];
        $mock = new MockHandler([new Response(500, [], json_encode($data))]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $picupApi = new PicupApi($client, 'api-123');

        $this->expectException(PicupRequestFailed::class);
        $this->expectExceptionMessage('IntegrationDetails Error: {"Message":"something else broke"}');

        $request = new StandardBusinessRequest('123-456');
        $picupApi->sendIntegrationDetailsRequest($request);
    }

    /**
     * This API method is not yet implemented properly.
     *
     * I don't have a valid live picup to test this with.
     *
     * @throws PicupApiException
     */
    public function testSendDispatchSummaryRequest(): void
    {
        $data = [
            'picup_count' => 1,
            'total_parcels' => 2,
            'pending_parcels' => 3,
            'failed_parcels' => 4,
            'completed_parcels' => 5,
            'parcels' => [
                [
                    'tracking_number' => '123',
                    'parcel_reference' => 'ref',
                    'status' => 'pending',
                    'failed_reason' => null,
                    'contact_name' => 'name',
                    'contact_phone' => 'phone',
                ]
            ]
        ];
        $mock = new MockHandler([new Response(200, [], json_encode($data))]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $picupApi = new PicupApi($client, 'api-123');

        $request = new StandardBusinessRequest('123-456');
        $dispatchSummary = $picupApi->sendDispatchSummaryRequest($request);

        // ASSERT RETURNED OBJECT IS CORRECT

        $this->assertEquals(1, $dispatchSummary->getPicupCount());
    }

    /**
     * @throws PicupApiException
     */
    public function testSendDispatchSummaryRequestWithInvalidResponse(): void
    {
        $data = [
            'Message' => 'something broke again'
        ];
        $mock = new MockHandler([new Response(500, [], json_encode($data))]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $picupApi = new PicupApi($client, 'api-123');

        $this->expectException(PicupApiException::class);
        $this->expectExceptionMessage('something broke again');

        $request = new StandardBusinessRequest('123-456');
        $picupApi->sendDispatchSummaryRequest($request);
    }
}
