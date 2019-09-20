<?php

namespace PicupTechnologies\PicupPHPApi\Tests\Responses;

use PicupTechnologies\PicupPHPApi\Objects\DeliveryServiceType;
use PicupTechnologies\PicupPHPApi\Responses\DeliveryQuoteResponse;
use PHPUnit\Framework\TestCase;

class DeliveryQuoteResponseTest extends TestCase
{
    public function testBasics(): void
    {
        $response = new DeliveryQuoteResponse();

        $response->setValid(true);
        $this->assertTrue($response->isValid());

        $response->setValid(false);
        $this->assertFalse($response->isValid());

        $errorMessage = 'testing this error message';
        $response->setError($errorMessage);
        $this->assertEquals($errorMessage, $response->getError());

        $serviceType = new DeliveryServiceType();

        $response->setServiceTypes([$serviceType]);
        $this->assertCount(1, $response->getServiceTypes());
        $this->assertEquals($serviceType, $response->getServiceTypes()[0]);

        $serviceTypeTwo = new DeliveryServiceType();
        $response->addServiceType($serviceTypeTwo);

        $types = $response->getServiceTypes();
        $this->assertCount(2, $types);
        $this->assertEquals($serviceType, $types[0]);
        $this->assertEquals($serviceTypeTwo, $types[1]);
    }
}
