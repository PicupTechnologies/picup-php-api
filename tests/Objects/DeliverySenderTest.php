<?php

declare(strict_types=1);

namespace PicupTechnologies\PicupPHPApi\Tests\Objects;

use PHPUnit\Framework\TestCase;
use PicupTechnologies\PicupPHPApi\Collections\ParcelCollection;
use PicupTechnologies\PicupPHPApi\Enums\ParcelSizeEnum;
use PicupTechnologies\PicupPHPApi\Objects\DeliverySender;
use PicupTechnologies\PicupPHPApi\Objects\DeliverySenderAddress;
use PicupTechnologies\PicupPHPApi\Objects\DeliverySenderContact;
use PicupTechnologies\PicupPHPApi\Objects\Parcel;
use PicupTechnologies\PicupPHPApi\Objects\ParcelDimensions;

class DeliverySenderTest extends TestCase
{
    public function testBasics() : void
    {
        $receiverAddress = new DeliverySenderAddress();
        $receiverContact = new DeliverySenderContact();
        $parcels = new ParcelCollection();
        $parcels->addParcel(new Parcel(ParcelSizeEnum::PARCEL_MEDIUM, 'Medium Parcel', new ParcelDimensions(1, 2, 3), 0.0));

        $specialInstructions = 'Go away';

        $receiver = new DeliverySender($receiverAddress, $receiverContact, $specialInstructions);

        $this->assertSame($receiverAddress, $receiver->getAddress());
        $this->assertSame($receiverContact, $receiver->getContact());
        $this->assertSame($specialInstructions, $receiver->getSpecialInstructions());
    }
}
