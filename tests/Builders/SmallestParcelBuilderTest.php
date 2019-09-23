<?php

namespace PicupTechnologies\PicupPHPApi\Tests\Builders;

use PicupTechnologies\PicupPHPApi\Builders\SmallestParcelBuilder;
use PHPUnit\Framework\TestCase;
use PicupTechnologies\PicupPHPApi\Objects\Parcel;
use PicupTechnologies\PicupPHPApi\Objects\ParcelDimensions;

class SmallestParcelBuilderTest extends TestCase
{
    /** @var SmallestParcelBuilder */
    private $builder;

    public function setUp()
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

    public function testProductTooBigForSmall(): void
    {
        // test height
        $parcel = $this->builder->find(99, 100, 300);
        $this->assertEquals('parcel-small', $parcel->getId());

        // test width
        $parcel = $this->builder->find(100, 199, 300);
        $this->assertEquals('parcel-small', $parcel->getId());

        // test length
        $parcel = $this->builder->find(100, 200, 299);
        $this->assertEquals('parcel-small', $parcel->getId());

        $parcel = $this->builder->find(150, 100, 150);
        $this->assertEquals('parcel-medium', $parcel->getId());

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
}
