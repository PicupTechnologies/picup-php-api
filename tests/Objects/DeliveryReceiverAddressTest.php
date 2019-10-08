<?php

declare(strict_types=1);

namespace PicupTechnologies\PicupPHPApi\Tests\Objects;

use PHPUnit\Framework\TestCase;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryReceiverAddress;

class DeliveryReceiverAddressTest extends TestCase
{
    public function testBasics() : void
    {
        $deliveryAddress = new DeliveryReceiverAddress();

        $deliveryAddress->setUnitNo('5');
        $this->assertSame('5', $deliveryAddress->getUnitNo());

        $test = 'complex string';
        $deliveryAddress->setComplex($test);
        $this->assertSame($test, $deliveryAddress->getComplex());

        $test = '15B';
        $deliveryAddress->setStreetOrFarmNo($test);
        $this->assertSame($test, $deliveryAddress->getStreetOrFarmNo());

        $test = 'roeland street';
        $deliveryAddress->setStreetOrFarm($test);
        $this->assertSame($test, $deliveryAddress->getStreetOrFarm());

        $test = 'claremont';
        $deliveryAddress->setSuburb($test);
        $this->assertSame($test, $deliveryAddress->getSuburb());

        $test = 'cape town';
        $deliveryAddress->setCity($test);
        $this->assertSame($test, $deliveryAddress->getCity());

        $test = '8001';
        $deliveryAddress->setPostalCode($test);
        $this->assertSame($test, $deliveryAddress->getPostalCode());

        $test = 'south africa';
        $deliveryAddress->setCountry($test);
        $this->assertSame($test, $deliveryAddress->getCountry());

        $test = 18.03235;
        $deliveryAddress->setLatitude($test);
        $this->assertSame($test, $deliveryAddress->getLatitude());

        $test = 4.5035673;
        $deliveryAddress->setLongitude($test);
        $this->assertSame($test, $deliveryAddress->getLongitude());
    }

    public function testSerializes() : void
    {
        $deliveryAddress = new DeliveryReceiverAddress();

        $deliveryAddress->setUnitNo('5');
        $deliveryAddress->setComplex('view heights');
        $deliveryAddress->setStreetOrFarmNo('5a');
        $deliveryAddress->setStreetOrFarm('the vineyards');
        $deliveryAddress->setCity('cape town');
        $deliveryAddress->setPostalCode('8005');

        $serialized = json_encode($deliveryAddress);
        $unserialized = json_decode($serialized, true);

        $this->assertSame('5', $unserialized['unit_no']);
        $this->assertSame('view heights', $unserialized['complex']);
        $this->assertSame('5a', $unserialized['street_or_farm_no']);
        $this->assertSame('the vineyards', $unserialized['street_or_farm']);
        $this->assertSame('cape town', $unserialized['city']);
        $this->assertSame('8005', $unserialized['postal_code']);
    }
}
