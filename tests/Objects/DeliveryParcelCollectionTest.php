<?php

declare(strict_types=1);

namespace PicupTechnologies\PicupPHPApi\Tests\Objects;

use PHPUnit\Framework\TestCase;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryParcel;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryParcelCollection;

class DeliveryParcelCollectionTest extends TestCase
{
    public function testBasics() : void
    {
        $collection = new DeliveryParcelCollection();

        $parcel = new DeliveryParcel('ref-123', 'parcel-extra');
        $this->assertSame('ref-123', $parcel->getReference());
        $this->assertSame('parcel-extra', $parcel->getSize());

        $this->assertNull($collection->getParcels());

        $collection->addParcel($parcel);

        $anotherParcel = new DeliveryParcel('ref-555', 'parcel-medium');
        $collection->addParcel($anotherParcel);

        $parcels = $collection->getParcels();
        $this->assertSame($parcel, $parcels[0]);
        $this->assertSame($anotherParcel, $parcels[1]);
    }

    public function testJsonSerialize() : void
    {
        $collection = new DeliveryParcelCollection();
        $parcel = new DeliveryParcel('ref-123', 'parcel-extra');
        $collection->addParcel($parcel);

        $decoded = json_decode(json_encode($collection), true);

        $this->assertCount(1, $decoded);
        $this->assertSame('ref-123', $decoded[0]['reference']);
        $this->assertSame('parcel-extra', $decoded[0]['size']);
    }
}
