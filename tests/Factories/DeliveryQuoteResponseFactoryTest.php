<?php

namespace PicupTechnologies\PicupPHPApi\Tests\Factories;

use PicupTechnologies\PicupPHPApi\Factories\DeliveryQuoteResponseFactory;
use PHPUnit\Framework\TestCase;

class DeliveryQuoteResponseFactoryTest extends TestCase
{
    /**
     * @throws \Exception
     */
    public function testMakeWithValidPicup(): void
    {
        $json = [
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
        $body = json_encode($json);
        $deliveryQuoteResponse = DeliveryQuoteResponseFactory::make($body);

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
     * @throws \Exception
     */
    public function testMakeWithInvalidPicup(): void
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

        $this->assertEquals(false, $deliveryQuoteResponse->isValid());
    }
}
