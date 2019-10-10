<?php

declare(strict_types=1);

namespace PicupTechnologies\PicupPHPApi\Tests\Factories;

use PHPUnit\Framework\TestCase;
use PicupTechnologies\PicupPHPApi\Factories\DeliveryQuoteResponseFactory;

class DeliveryQuoteResponseFactoryTest extends TestCase
{
    /**
     * @throws \Exception
     */
    public function testMakeWithValidPicup() : void
    {
        $json = [
            'picup' => [
                'valid' => 1,
                'service_types' => [
                    [
                        'description' => 'vehicle-space-ship',
                        'price_incl_vat' => 500.123,
                        'price_ex_vat' => 400.5,
                        'duration' => '24:00:00',
                        'distance' => 123.45
                    ]
                ]
            ]
        ];
        $body = json_encode($json);
        $deliveryQuoteResponse = DeliveryQuoteResponseFactory::make($body);

        $this->assertTrue($deliveryQuoteResponse->isValid());

        $serviceTypes = $deliveryQuoteResponse->getServiceTypes();
        $this->assertCount(1, $serviceTypes);

        $serviceType = $serviceTypes[0];
        $this->assertSame('vehicle-space-ship', $serviceType->getDescription());
        $this->assertSame(500.123, $serviceType->getPriceInclusive());
        $this->assertSame(400.5, $serviceType->getPriceExclusive());
        $this->assertSame('24:00:00', $serviceType->getDuration());
        $this->assertSame(123.45, $serviceType->getDistance());
        $this->assertSame('Space Ship', $serviceType->getVehicleName());
    }

    /**
     * @throws \Exception
     */
    public function testMakeWithInvalidPicup() : void
    {
        $json = [
            'picup' => [
                'valid' => 0,
                'error' => 'Picup is invalid',
                'service_types' => [

                ]
            ]
        ];
        $body = json_encode($json);
        $deliveryQuoteResponse = DeliveryQuoteResponseFactory::make($body);

        $this->assertFalse($deliveryQuoteResponse->isValid());
    }
}
