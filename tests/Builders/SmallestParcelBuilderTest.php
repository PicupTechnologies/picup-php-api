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

        $parcels[] = new Parcel(
            'parcel-small',
            'Small Parcel',
            new ParcelDimensions(100, 200, 300),
            100
        );

        $parcels[] = new Parcel(
            'parcel-medium',
            'Medium Parcel',
            new ParcelDimensions(200, 300, 400),
            100
        );

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
        // Add a medium parcel
        $parcels[] = new Parcel(
            'parcel-medium',
            'Medium Parcel',
            new ParcelDimensions(200, 200, 200),
            100
        );

        // Add a small parcel
        $parcels[] = new Parcel(
            'parcel-small',
            'Small Parcel',
            new ParcelDimensions(100, 100, 100),
            50
        );

        // Add a large parcel
        $parcels[] = new Parcel(
            'parcel-large',
            'Large Parcel',
            new ParcelDimensions(300, 300, 300),
            150
        );

        $this->builder = new SmallestParcelBuilder($parcels);

        // The parcels should be sorted now

        $parcels = $this->builder->getParcels();
        $this->assertSame('parcel-small', $parcels[0]->getId());
        $this->assertSame('parcel-medium', $parcels[1]->getId());
        $this->assertSame('parcel-large', $parcels[2]->getId());
    }
}
