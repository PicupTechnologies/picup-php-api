<?php

declare(strict_types=1);

namespace PicupTechnologies\PicupPHPApi\Tests\Objects\DeliveryBucket;

use Faker\Factory;
use PHPUnit\Framework\TestCase;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryBucket\DeliveryShipmentParcel;

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

    protected function setUp() : void
    {
        parent::setUp();

        $this->faker = Factory::create();
        $this->subject = new DeliveryShipmentParcel();
    }

    public function testSize() : void
    {
        $test = $this->faker->name;

        $this->subject->setSize($test);
        $this->assertSame($test, $this->subject->getSize());
    }

    public function testTrackingNumber() : void
    {
        $test = $this->faker->name;

        $this->subject->setTrackingNumber($test);
        $this->assertSame($test, $this->subject->getTrackingNumber());
    }

    public function testParcelReference() : void
    {
        $test = $this->faker->name;

        $this->subject->setParcelReference($test);
        $this->assertSame($test, $this->subject->getParcelReference());
    }

    public function testDescription() : void
    {
        $test = $this->faker->name;

        $this->subject->setDescription($test);
        $this->assertSame($test, $this->subject->getDescription());
    }
}
