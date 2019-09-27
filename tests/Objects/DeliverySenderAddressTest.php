<?php

namespace PicupTechnologies\PicupPHPApi\Tests\Objects;

use PHPUnit\Framework\TestCase;
use PicupTechnologies\PicupPHPApi\Objects\DeliverySenderAddress;

class DeliverySenderAddressTest extends TestCase
{
    public function testMake(): void
    {
        $address = new DeliverySenderAddress();

        $address->setWarehouseId('warehouse-555');
        $this->assertEquals('warehouse-555', $address->getWarehouseId());

        $decoded = json_decode(json_encode($address), false);

        $this->assertEquals('warehouse-555', $decoded->warehouse_id);
    }
}
