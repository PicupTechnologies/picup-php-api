<?php

namespace PicupTechnologies\PicupPHPApi\Tests\Factories;

use PicupTechnologies\PicupPHPApi\Factories\ThirdPartyResponseFactory;
use PHPUnit\Framework\TestCase;

class ThirdPartyResponseFactoryTest extends TestCase
{
    public function testMake()
    {
        $fixture = file_get_contents(__DIR__ . '/../Fixtures/ThirdPartyResponse.json');
        $object = json_decode($fixture, false);

        $response = ThirdPartyResponseFactory::make($object);

        $json = json_encode($response, JSON_PRETTY_PRINT);

        //print_r($response);
        //exit;
        //print_r($json);

        //$this->assertEquals($fixture, $json);
    }
}
