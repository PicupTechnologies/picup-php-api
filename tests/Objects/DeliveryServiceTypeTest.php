<?php

namespace PicupTechnologies\PicupPHPApi\Tests\Objects;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryServiceType;

class DeliveryServiceTypeTest extends TestCase
{
    public function testGetVehicleName(): void
    {
        $serviceType = new DeliveryServiceType();

        $serviceType->setDescription('vehicle-bicycle');
        $this->assertEquals('Bicycle', $serviceType->getVehicleName());
    }

    public function testGetVehicleNameWithInvalidDescription(): void
    {
        $serviceType = new DeliveryServiceType();

        $serviceType->setDescription('vehicle_without_dashes');
        $this->expectException(InvalidArgumentException::class);

        $serviceType->getVehicleName();
    }
}
