<?php

namespace PicupTechnologies\PicupPHPApi\Tests;

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
            ]
        ];

        $deliveryIntegrationDetails = DeliveryIntegrationDetailsResponseFactory::make($request);

        $this->assertEquals($request['is_key_valid'], $deliveryIntegrationDetails->isKeyValid());
        $this->assertEquals($request['is_key_valid_message'], $deliveryIntegrationDetails->getIsKeyValidMessage());

        $deliveryWarehouses = $deliveryIntegrationDetails->getWarehouses();
        $this->assertCount(1, $deliveryWarehouses);

        $this->assertEquals($request['warehouses'][0]['warehouse_id'], $deliveryWarehouses[0]->getId());
        $this->assertEquals($request['warehouses'][0]['warehouse_name'], $deliveryWarehouses[0]->getName());
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
