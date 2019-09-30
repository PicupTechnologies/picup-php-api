<?php

namespace PicupTechnologies\PicupPHPApi\Tests\Objects;

use PicupTechnologies\PicupPHPApi\Objects\DeliveryParcel;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryParcelCollection;
use PHPUnit\Framework\TestCase;

class DeliveryParcelCollectionTest extends TestCase
{
    public function testBasics(): void
    {
        $collection = new DeliveryParcelCollection();

        $parcel = new DeliveryParcel('ref-123', 'parcel-extra');
        $this->assertEquals('ref-123', $parcel->getReference());
        $this->assertEquals('parcel-extra', $parcel->getSize());

        $this->assertEquals(null, $collection->getParcels());

        $collection->addParcel($parcel);

        $anotherParcel = new DeliveryParcel('ref-555', 'parcel-medium');
        $collection->addParcel($anotherParcel);

        $parcels = $collection->getParcels();
        $this->assertEquals($parcel, $parcels[0]);
        $this->assertEquals($anotherParcel, $parcels[1]);
    }

    public function testJsonSerialize(): void
    {
        $collection = new DeliveryParcelCollection();
        $parcel = new DeliveryParcel('ref-123', 'parcel-extra');
        $collection->addParcel($parcel);

        $decoded = json_decode(json_encode($collection), true);

        $this->assertCount(1, $decoded);
        $this->assertEquals('ref-123', $decoded[0]['reference']);
        $this->assertEquals('parcel-extra', $decoded[0]['size']);
    }
}
