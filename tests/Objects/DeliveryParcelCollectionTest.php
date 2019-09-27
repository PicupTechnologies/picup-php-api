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

        $this->assertEquals($parcel, $collection->getParcels()[0]);
    }
}
