<?php

declare(strict_types=1);

namespace PicupTechnologies\PicupPHPApi\Tests\Objects;

use PHPUnit\Framework\TestCase;
use PicupTechnologies\PicupPHPApi\Collections\ParcelCollection;
use PicupTechnologies\PicupPHPApi\Enums\ParcelSizeEnum;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryReceiver;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryReceiverAddress;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryReceiverContact;
use PicupTechnologies\PicupPHPApi\Objects\Parcel;
use PicupTechnologies\PicupPHPApi\Objects\ParcelDimensions;

class DeliveryReceiverTest extends TestCase
{
    public function test() : void
    {
        $receiverAddress = new DeliveryReceiverAddress();
        $receiverContact = new DeliveryReceiverContact();
        $parcels = new ParcelCollection();
        $parcels->addParcel(new Parcel(ParcelSizeEnum::PARCEL_MEDIUM, 'Medium Parcel', new ParcelDimensions(1, 2, 3), 0.0));
        $specialInstructions = 'Go away';

        $receiver = new DeliveryReceiver($receiverAddress, $receiverContact, $parcels, $specialInstructions);

        $this->assertSame($receiverAddress, $receiver->getAddress());
        $this->assertSame($receiverContact, $receiver->getContact());
        $this->assertSame($parcels, $receiver->getParcels());
        $this->assertSame($specialInstructions, $receiver->getSpecialInstructions());
    }
}
