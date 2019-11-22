<?php

namespace PicupTechnologies\PicupPHPApi\Tests\Factories;

use PicupTechnologies\PicupPHPApi\Factories\ThirdPartyCollectionCollectionFactory;
use PicupTechnologies\PicupPHPApi\Factories\ThirdPartyResponseFactory;
use PHPUnit\Framework\TestCase;

class ThirdPartyResponseFactoryTest extends TestCase
{
    public function testMakeFullResponse()
    {
        // fetch the fixture
        $fixture = file_get_contents(__DIR__ . '/../Fixtures/ThirdPartyResponse.json');

        // decode it to a json object
        $object = json_decode($fixture, false);

        // build a third party response from the json object
        $response = ThirdPartyResponseFactory::make($object);

        $this->assertNotNull($response);
    }
}
