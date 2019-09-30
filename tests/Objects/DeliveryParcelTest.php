<?php

namespace PicupTechnologies\PicupPHPApi\Tests\Objects;

use PHPUnit\Framework\TestCase;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryParcel;

class DeliveryParcelTest extends TestCase
{
    public function testBasics(): void
    {
        $parcel = new DeliveryParcel('ref-123', 'parcel-extra');

        $this->assertEquals('ref-123', $parcel->getReference());
        $this->assertEquals('parcel-extra', $parcel->getSize());
    }

    public function testJsonSerialize(): void
    {
        $parcel = new DeliveryParcel('ref-123', 'parcel-extra');

        $decoded = json_decode(json_encode($parcel), false);

        $this->assertEquals($parcel->getSize(), $decoded->size);
        $this->assertEquals($parcel->getReference(), $decoded->reference);
    }
}
