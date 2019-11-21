<?php

namespace PicupTechnologies\PicupPHPApi\Tests\Factories;

use PicupTechnologies\PicupPHPApi\Factories\ThirdPartyCollectionCollectionFactory;
use PHPUnit\Framework\TestCase;

class ThirdPartyCollectionFactoryTest extends TestCase
{
    public function testMakeThirdPartyCollection()
    {
        // fetch the fixture
        $fixture = file_get_contents(__DIR__ . '/../Fixtures/ThirdPartyCollection.json');

        // decode it to a json object
        $object = json_decode($fixture, false);

        // build a third party response from the json object
        $response = ThirdPartyCollectionCollectionFactory::make($object);

        $this->assertNotNull($response);
    }
}
