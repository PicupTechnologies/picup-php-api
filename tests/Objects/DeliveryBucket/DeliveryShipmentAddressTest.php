<?php

declare(strict_types=1);

namespace PicupTechnologies\PicupPHPApi\Tests\Objects\DeliveryBucket;

use Faker\Factory;
use PHPUnit\Framework\TestCase;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryBucket\DeliveryShipmentAddress;

class DeliveryShipmentAddressTest extends TestCase
{
    /**
     * @var Factory
     */
    protected $faker;

    /**
     * @var DeliveryShipmentAddress
     */
    protected $subject;

    protected function setUp() : void
    {
        parent::setUp();

        $this->faker = Factory::create();
        $this->subject = new DeliveryShipmentAddress();
    }

    public function testAddressReference() : void
    {
        $test = 'ref-555';

        $this->subject->setAddressReference($test);
        $this->assertSame($test, $this->subject->getAddressReference());
    }

    public function testAddressLines() : void
    {
        $test = $this->faker->address;
        $this->subject->setAddressLine1($test);
        $this->assertSame($test, $this->subject->getAddressLine1());

        $test = $this->faker->address;
        $this->subject->setAddressLine2($test);
        $this->assertSame($test, $this->subject->getAddressLine2());

        $test = $this->faker->address;
        $this->subject->setAddressLine3($test);
        $this->assertSame($test, $this->subject->getAddressLine3());

        $test = $this->faker->address;
        $this->subject->setAddressLine4($test);
        $this->assertSame($test, $this->subject->getAddressLine4());
    }

    public function testCity() : void
    {
        $test = $this->faker->city;

        $this->subject->setCity($test);
        $this->assertSame($test, $this->subject->getCity());
    }

    public function testCoordinates() : void
    {
        $lat = $this->faker->latitude;
        $this->subject->setLatitude($lat);
        $this->assertSame($lat, $this->subject->getLatitude());

        $lng = $this->faker->longitude;
        $this->subject->setLongitude($lng);
        $this->assertSame($lng, $this->subject->getLongitude());
    }

    public function testFormattedAddress() : void
    {
        $test = $this->faker->address;

        $this->subject->setFormattedAddress($test);
        $this->assertSame($test, $this->subject->getFormattedAddress());
    }

    public function testCountry() : void
    {
        $test = $this->faker->country;

        $this->subject->setCountry($test);
        $this->assertSame($test, $this->subject->getCountry());
    }

    public function testSuburb() : void
    {
        $test = $this->faker->city;

        $this->subject->setSuburb($test);
        $this->assertSame($test, $this->subject->getSuburb());
    }

    public function testJsonSerialize() : void
    {
        $addressRef = 'address-ref';
        $this->subject->setAddressReference($addressRef);
        $this->subject->setAddressLine1('address-1');

        $json = json_encode($this->subject);

        $decoded = json_decode($json, false);
        $this->assertSame($addressRef, $decoded->address_reference);
    }
}
