<?php

declare(strict_types=1);

namespace PicupTechnologies\PicupPHPApi\Tests\Responses;

use PHPUnit\Framework\TestCase;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryServiceType;
use PicupTechnologies\PicupPHPApi\Responses\DeliveryQuoteResponse;

class DeliveryQuoteResponseTest extends TestCase
{
    public function testBasics() : void
    {
        $response = new DeliveryQuoteResponse();

        $response->setValid(true);
        $this->assertTrue($response->isValid());

        $response->setValid(false);
        $this->assertFalse($response->isValid());

        $errorMessage = 'testing this error message';
        $response->setError($errorMessage);
        $this->assertSame($errorMessage, $response->getError());

        $serviceType = new DeliveryServiceType();

        $response->setServiceTypes([$serviceType]);
        $this->assertCount(1, $response->getServiceTypes());
        $this->assertSame($serviceType, $response->getServiceTypes()[0]);

        $serviceTypeTwo = new DeliveryServiceType();
        $response->addServiceType($serviceTypeTwo);

        $types = $response->getServiceTypes();
        $this->assertCount(2, $types);
        $this->assertSame($serviceType, $types[0]);
        $this->assertSame($serviceTypeTwo, $types[1]);
    }
}
