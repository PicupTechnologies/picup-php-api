<?php

namespace PicupTechnologies\PicupPHPApi\Tests\Objects;

use PicupTechnologies\PicupPHPApi\Enums\ParcelSizeEnum;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryParcel;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryParcelCollection;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryReceiver;
use PHPUnit\Framework\TestCase;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryReceiverAddress;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryReceiverContact;

class DeliveryReceiverTest extends TestCase
{
    public function test(): void
    {
        $receiverAddress = new DeliveryReceiverAddress();
        $receiverContact = new DeliveryReceiverContact();
        $parcels = new DeliveryParcelCollection();
        $parcels->addParcel(new DeliveryParcel('test-ref', ParcelSizeEnum::PARCEL_MEDIUM));
        $specialInstructions = 'Go away';

        $receiver = new DeliveryReceiver($receiverAddress, $receiverContact, $parcels, $specialInstructions);

        $this->assertEquals($receiverAddress, $receiver->getAddress());
        $this->assertEquals($receiverContact, $receiver->getContact());
        $this->assertEquals($parcels, $receiver->getParcels());
        $this->assertEquals($specialInstructions, $receiver->getSpecialInstructions());
    }
}
