<?php

namespace PicupTechnologies\PicupPHPApi\Tests\Objects\DeliveryBucket;

use Faker\Factory;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryBucket\DeliveryShipmentAddress;
use PHPUnit\Framework\TestCase;

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

    public function setUp(): void
    {
        parent::setUp();

        $this->faker = Factory::create();
        $this->subject = new DeliveryShipmentAddress();
    }

    public function testAddressReference(): void
    {
        $test = 'ref-555';

        $this->subject->setAddressReference($test);
        $this->assertEquals($test, $this->subject->getAddressReference());
    }

    public function testAddressLines(): void
    {
        $test = $this->faker->address;
        $this->subject->setAddressLine1($test);
        $this->assertEquals($test, $this->subject->getAddressLine1());

        $test = $this->faker->address;
        $this->subject->setAddressLine2($test);
        $this->assertEquals($test, $this->subject->getAddressLine2());

        $test = $this->faker->address;
        $this->subject->setAddressLine3($test);
        $this->assertEquals($test, $this->subject->getAddressLine3());

        $test = $this->faker->address;
        $this->subject->setAddressLine4($test);
        $this->assertEquals($test, $this->subject->getAddressLine4());
    }

    public function testCity(): void
    {
        $test = $this->faker->city;

        $this->subject->setCity($test);
        $this->assertEquals($test, $this->subject->getCity());
    }

    public function testCoordinates(): void
    {
        $lat = $this->faker->latitude;
        $this->subject->setLatitude($lat);
        $this->assertEquals($lat, $this->subject->getLatitude());

        $lng = $this->faker->longitude;
        $this->subject->setLongitude($lng);
        $this->assertEquals($lng, $this->subject->getLongitude());
    }

    public function testFormattedAddress(): void
    {
        $test = $this->faker->address;

        $this->subject->setFormattedAddress($test);
        $this->assertEquals($test, $this->subject->getFormattedAddress());
    }

    public function testCountry(): void
    {
        $test = $this->faker->country;

        $this->subject->setCountry($test);
        $this->assertEquals($test, $this->subject->getCountry());
    }

    public function testSuburb(): void
    {
        $test = $this->faker->city;

        $this->subject->setSuburb($test);
        $this->assertEquals($test, $this->subject->getSuburb());
    }

    public function testJsonSerialize(): void
    {
        $addressRef = 'address-ref';
        $this->subject->setAddressReference($addressRef);
        $this->subject->setAddressLine1('address-1');

        $json = json_encode($this->subject);

        $decoded = json_decode($json, false);
        $this->assertEquals($addressRef, $decoded->address_reference);
    }
}
