<?php

namespace PicupTechnologies\PicupPHPApi\Tests\Services;

use PHPUnit\Framework\MockObject\MockObject;
use PicupTechnologies\PicupPHPApi\Contracts\DeliveryAdapterInterface;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryBucket\DeliveryBucket;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryIntegrationDetailsResponse;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryOrderRequest;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryOrderResponse;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryQuoteRequest;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryQuoteResponse;
use PicupTechnologies\PicupPHPApi\Services\DeliveryService;
use PHPUnit\Framework\TestCase;

class DeliveryServiceTest extends TestCase
{
    public function testSendQuoteRequest()
    {
        $deliveryAdapter = $this->createMock(DeliveryAdapterInterface::class);

        $quoteResponseExpected = new DeliveryQuoteResponse();
        $deliveryAdapter
            ->expects($this->once())
            ->method('sendQuoteRequest')
            ->willReturn($quoteResponseExpected);

        /** @var DeliveryAdapterInterface| MockObject $deliveryAdapter */
        $deliveryService = new DeliveryService($deliveryAdapter);

        $quoteRequest = new DeliveryQuoteRequest();
        $quoteResponse = $deliveryService->sendQuoteRequest($quoteRequest);
    }

    public function testSendOrderRequest()
    {
        $deliveryAdapter = $this->createMock(DeliveryAdapterInterface::class);

        $request = new DeliveryOrderRequest();
        $response = new DeliveryOrderResponse('555');

        $deliveryAdapter
            ->expects($this->once())
            ->method('sendOrderRequest')
            ->willReturn($response);

        /** @var DeliveryAdapterInterface| MockObject $deliveryAdapter */
        $deliveryService = new DeliveryService($deliveryAdapter);

        $serviceResponse = $deliveryService->sendOrderRequest($request);
        $this->assertEquals(555, $serviceResponse->getId());
    }

    public function testSendDeliveryBucket()
    {
        $deliveryAdapter = $this->createMock(DeliveryAdapterInterface::class);

        $request = new DeliveryBucket();
        $response = new DeliveryOrderResponse('555');

        $deliveryAdapter
            ->expects($this->once())
            ->method('sendDeliveryBucket')
            ->willReturn($response);

        /** @var DeliveryAdapterInterface| MockObject $deliveryAdapter */
        $deliveryService = new DeliveryService($deliveryAdapter);

        $serviceResponse = $deliveryService->sendDeliveryBucket($request);
        $this->assertEquals(555, $serviceResponse->getId());
    }

    /**
     * @throws \PicupTechnologies\PicupPHPApi\Exceptions\PicupApiKeyInvalid
     */
    public function testFetchIntegrationDetails()
    {
        $deliveryAdapter = $this->createMock(DeliveryAdapterInterface::class);

        $response = new DeliveryIntegrationDetailsResponse(
            true,
            'Key is valid',
            []
        );

        $deliveryAdapter
            ->expects($this->once())
            ->method('sendIntegrationDetailsRequest')
            ->willReturn($response);

        /** @var DeliveryAdapterInterface| MockObject $deliveryAdapter */
        $deliveryService = new DeliveryService($deliveryAdapter);

        $serviceResponse = $deliveryService->fetchIntegrationDetails('business-123');
        $this->assertEquals(true, $serviceResponse->isKeyValid());
    }
}
