<?php

namespace PicupTechnologies\PicupPHPApi\Tests\Factories;

use PHPUnit\Framework\TestCase;
use PicupTechnologies\PicupPHPApi\Factories\DeliveryIntegrationDetailsResponseFactory;

class DeliveryIntegrationDetailsResponseFactoryTest extends TestCase
{
    public function testMakeWithValidApiKey(): void
    {
        $request = [
            'is_key_valid' => true,
            'is_key_valid_message' => 'Key is valid',
            'warehouses' => [
                ['warehouse_id' => 'warehouse-123', 'warehouse_name' => 'Test Warehouse']
            ],
            'parcel_sizes' => [
                [
                    'display_name' => 'Small',
                    'parcel_id' => 'parcel-small',
                    'dimensions' => [
                        'height' => 30, 'width' => 15, 'length' => 35
                    ],
                    'weight' => 0
                ],
                [
                    'display_name' => 'A4 Envelope',
                    'parcel_id' => 'parcel-a4-envelope',
                    'dimensions' => [
                        'height' => 6, 'width' => 3, 'length' => 8
                    ],
                    'weight' => 0
                ],
            ]
        ];

        $deliveryIntegrationDetails = DeliveryIntegrationDetailsResponseFactory::make($request);

        $this->assertEquals($request['is_key_valid'], $deliveryIntegrationDetails->isKeyValid());
        $this->assertEquals($request['is_key_valid_message'], $deliveryIntegrationDetails->getIsKeyValidMessage());

        $deliveryWarehouses = $deliveryIntegrationDetails->getWarehouses();
        $this->assertCount(1, $deliveryWarehouses);

        $this->assertEquals($request['warehouses'][0]['warehouse_id'], $deliveryWarehouses[0]->getId());
        $this->assertEquals($request['warehouses'][0]['warehouse_name'], $deliveryWarehouses[0]->getName());

        $parcels = $deliveryIntegrationDetails->getParcels();
        $this->assertCount(2, $parcels);

        $this->assertEquals('parcel-small', $parcels[0]->getId());
        $this->assertEquals('Small', $parcels[0]->getDisplayName());
        $this->assertEquals(0, $parcels[0]->getWeight());
        $this->assertEquals(30, $parcels[0]->getDimensions()->getHeight());
        $this->assertEquals(15, $parcels[0]->getDimensions()->getWidth());
        $this->assertEquals(35, $parcels[0]->getDimensions()->getLength());

        $this->assertEquals('parcel-a4-envelope', $parcels[1]->getId());
        $this->assertEquals('A4 Envelope', $parcels[1]->getDisplayName());
        $this->assertEquals(0, $parcels[1]->getWeight());
        $this->assertEquals(6, $parcels[1]->getDimensions()->getHeight());
        $this->assertEquals(3, $parcels[1]->getDimensions()->getWidth());
        $this->assertEquals(8, $parcels[1]->getDimensions()->getLength());
    }

    public function testMakeWithInvalidApiKey(): void
    {
        $request = [
            'is_key_valid' => false,
            'is_key_valid_message' => 'Key is invalid',
        ];

        $deliveryIntegrationDetails = DeliveryIntegrationDetailsResponseFactory::make($request);

        $this->assertEquals($request['is_key_valid'], $deliveryIntegrationDetails->isKeyValid());
        $this->assertEquals($request['is_key_valid_message'], $deliveryIntegrationDetails->getIsKeyValidMessage());

        $this->assertCount(0, $deliveryIntegrationDetails->getWarehouses());
    }
}
