<?php

namespace PicupTechnologies\PicupPHPApi\Tests\Objects\DeliveryBucket;

use Faker\Factory;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryBucket\DeliveryShipmentContact;
use PHPUnit\Framework\TestCase;

class DeliveryShipmentContactTest extends TestCase
{
    /**
     * @var Factory
     */
    protected $faker;

    /**
     * @var DeliveryShipmentContact
     */
    protected $subject;

    public function setUp(): void
    {
        parent::setUp();

        $this->faker = Factory::create();
        $this->subject = new DeliveryShipmentContact();
    }

    public function testCustomerName(): void
    {
        $test = $this->faker->name;

        $this->subject->setCustomerName($test);
        $this->assertEquals($test, $this->subject->getCustomerName());

        $this->subject->setCustomerName(' bob bobby ');
        $this->assertEquals('bob bobby', $this->subject->getCustomerName());
    }

    public function testCustomerPhone(): void
    {
        $test = $this->faker->phoneNumber;

        $this->subject->setCustomerPhone($test);
        $this->assertEquals($test, $this->subject->getCustomerPhone());
    }

    public function testCustomerEmail(): void
    {
        $test = $this->faker->email;

        $this->subject->setEmailAddress($test);
        $this->assertEquals($test, $this->subject->getEmailAddress());

        $this->expectException(\InvalidArgumentException::class);
        $this->subject->setEmailAddress('invalid');
    }

    public function testSpecialInstructions(): void
    {
        $test = $this->faker->sentence;

        $this->subject->setSpecialInstructions($test);
        $this->assertEquals($test, $this->subject->getSpecialInstructions());
    }
}
