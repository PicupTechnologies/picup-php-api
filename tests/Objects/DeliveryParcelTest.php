<?php

declare(strict_types=1);

namespace PicupTechnologies\PicupPHPApi\Tests\Objects;

use PHPUnit\Framework\TestCase;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryParcel;

class DeliveryParcelTest extends TestCase
{
    public function testBasics() : void
    {
        $parcel = new DeliveryParcel('ref-123', 'parcel-extra');

        $this->assertSame('ref-123', $parcel->getReference());
        $this->assertSame('parcel-extra', $parcel->getSize());
    }

    public function testJsonSerialize() : void
    {
        $parcel = new DeliveryParcel('ref-123', 'parcel-extra');

        $decoded = json_decode(json_encode($parcel), false);

        $this->assertSame($parcel->getSize(), $decoded->size);
        $this->assertSame($parcel->getReference(), $decoded->reference);
    }
}
