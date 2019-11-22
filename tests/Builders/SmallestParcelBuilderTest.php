<?php

declare(strict_types=1);

namespace PicupTechnologies\PicupPHPApi\Tests\Builders;

use PHPUnit\Framework\TestCase;
use PicupTechnologies\PicupPHPApi\Builders\SmallestParcelBuilder;
use PicupTechnologies\PicupPHPApi\Objects\Parcel;
use PicupTechnologies\PicupPHPApi\Objects\ParcelDimensions;

class SmallestParcelBuilderTest extends TestCase
{
    /** @var SmallestParcelBuilder */
    private $builder;

    protected function setUp() : void
    {
        parent::setUp();

        $parcels = [];

        $parcel = new Parcel();
        $parcel->setId('parcel-small');
        $parcel->setDescription('Small Parcel');
        $parcel->setDimensions(new ParcelDimensions(100, 200, 300));
        $parcel->setWeight(100);

        $parcels[] = $parcel;

        $parcel = new Parcel();
        $parcel->setId('parcel-medium');
        $parcel->setDescription('Medium Parcel');
        $parcel->setDimensions(new ParcelDimensions(200, 300, 400));
        $parcel->setWeight(100);

        $parcels[] = $parcel;

        $this->builder = new SmallestParcelBuilder($parcels);
    }

    public function testProductTooBigForSmall() : void
    {
        // test height
        $parcel = $this->builder->find(99, 100, 300);
        $this->assertSame('parcel-small', $parcel->getId());

        // test width
        $parcel = $this->builder->find(100, 199, 300);
        $this->assertSame('parcel-small', $parcel->getId());

        // test length
        $parcel = $this->builder->find(100, 200, 299);
        $this->assertSame('parcel-small', $parcel->getId());

        $parcel = $this->builder->find(150, 100, 150);
        $this->assertSame('parcel-medium', $parcel->getId());

        // test with product too large for any parcel

        // height
        $parcel = $this->builder->find(500, 300, 400);
        $this->assertNull($parcel);

        // width
        $parcel = $this->builder->find(200, 301, 400);
        $this->assertNull($parcel);

        // length
        $parcel = $this->builder->find(200, 300, 401);
        $this->assertNull($parcel);
    }

    /**
     * Ensure the parcel builder sorts the incoming parcel list before
     * attempting to find
     */
    public function testSortingWorks() : void
    {
        $parcels = [];

        // Add a medium parcel
        $parcel = new Parcel();
        $parcel->setId('parcel-medium');
        $parcel->setDescription('Medium Parcel');
        $parcel->setDimensions(new ParcelDimensions(200, 200, 200));
        $parcel->setWeight(100);
        $parcels[] = $parcel;

        // Add a small parcel
        $parcel = new Parcel();
        $parcel->setId('parcel-small');
        $parcel->setDescription('Small Parcel');
        $parcel->setDimensions(new ParcelDimensions(100, 100, 100));
        $parcel->setWeight(50);
        $parcels[] = $parcel;

        // Add a large parcel
        $parcel = new Parcel();
        $parcel->setId('parcel-large');
        $parcel->setDescription('Large Parcel');
        $parcel->setDimensions(new ParcelDimensions(300, 300, 300));
        $parcel->setWeight(150);
        $parcels[] = $parcel;

        $this->builder = new SmallestParcelBuilder($parcels);

        // The parcels should be sorted now

        $parcels = $this->builder->getParcels();
        $this->assertSame('parcel-small', $parcels[0]->getId());
        $this->assertSame('parcel-medium', $parcels[1]->getId());
        $this->assertSame('parcel-large', $parcels[2]->getId());
    }
}
