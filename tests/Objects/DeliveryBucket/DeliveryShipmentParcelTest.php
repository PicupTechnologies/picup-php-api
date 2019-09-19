<?php

namespace PicupTechnologies\PicupPHPApi\Tests\Objects\DeliveryBucket;

use Faker\Factory;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryBucket\DeliveryShipmentParcel;
use PHPUnit\Framework\TestCase;

class DeliveryShipmentParcelTest extends TestCase
{
    /**
     * @var Factory
     */
    protected $faker;

    /**
     * @var DeliveryShipmentParcel
     */
    protected $subject;

    public function setUp(): void
    {
        parent::setUp();

        $this->faker = Factory::create();
        $this->subject = new DeliveryShipmentParcel();
    }

    public function testSize(): void
    {
        $test = $this->faker->name;

        $this->subject->setSize($test);
        $this->assertEquals($test, $this->subject->getSize());
    }

    public function testTrackingNumber(): void
    {
        $test = $this->faker->name;

        $this->subject->setTrackingNumber($test);
        $this->assertEquals($test, $this->subject->getTrackingNumber());
    }

    public function testParcelReference(): void
    {
        $test = $this->faker->name;

        $this->subject->setParcelReference($test);
        $this->assertEquals($test, $this->subject->getParcelReference());
    }

    public function testDescription(): void
    {
        $test = $this->faker->name;

        $this->subject->setDescription($test);
        $this->assertEquals($test, $this->subject->getDescription());
    }
}
