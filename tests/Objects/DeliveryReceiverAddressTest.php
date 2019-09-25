<?php

namespace PicupTechnologies\PicupPHPApi\Tests\Objects;

use PHPUnit\Framework\TestCase;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryReceiverAddress;

class DeliveryReceiverAddressTest extends TestCase
{
    public function testBasics(): void
    {
        $deliveryAddress = new DeliveryReceiverAddress();

        $deliveryAddress->setUnitNo(5);
        $this->assertEquals(5, $deliveryAddress->getUnitNo());

        $test = 'complex string';
        $deliveryAddress->setComplex($test);
        $this->assertEquals($test, $deliveryAddress->getComplex());

        $test = '15B';
        $deliveryAddress->setStreetOrFarmNo($test);
        $this->assertEquals($test, $deliveryAddress->getStreetOrFarmNo());

        $test = 'roeland street';
        $deliveryAddress->setStreetOrFarm($test);
        $this->assertEquals($test, $deliveryAddress->getStreetOrFarm());

        $test = 'claremont';
        $deliveryAddress->setSuburb($test);
        $this->assertEquals($test, $deliveryAddress->getSuburb());

        $test = 'cape town';
        $deliveryAddress->setCity($test);
        $this->assertEquals($test, $deliveryAddress->getCity());

        $test = '8001';
        $deliveryAddress->setPostalCode($test);
        $this->assertEquals($test, $deliveryAddress->getPostalCode());

        $test = 'south africa';
        $deliveryAddress->setCountry($test);
        $this->assertEquals($test, $deliveryAddress->getCountry());

        $test = 18.03235;
        $deliveryAddress->setLatitude($test);
        $this->assertEquals($test, $deliveryAddress->getLatitude());

        $test = 4.5035673;
        $deliveryAddress->setLongitude($test);
        $this->assertEquals($test, $deliveryAddress->getLongitude());
    }

    public function testSerializes(): void
    {
        $deliveryAddress = new DeliveryReceiverAddress();

        $deliveryAddress->setUnitNo(5);
        $deliveryAddress->setComplex('view heights');
        $deliveryAddress->setStreetOrFarmNo('5a');
        $deliveryAddress->setStreetOrFarm('the vineyards');
        $deliveryAddress->setCity('cape town');
        $deliveryAddress->setPostalCode(8005);

        $serialized = json_encode($deliveryAddress);
        $unserialized = json_decode($serialized, true);

        $this->assertEquals(5, $unserialized['unit_no']);
        $this->assertEquals('view heights', $unserialized['complex']);
        $this->assertEquals('5a', $unserialized['street_or_farm_no']);
        $this->assertEquals('the vineyards', $unserialized['street_or_farm']);
        $this->assertEquals('cape town', $unserialized['city']);
        $this->assertEquals(8005, $unserialized['postal_code']);
    }
}
