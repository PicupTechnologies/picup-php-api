<?php

declare(strict_types=1);

namespace PicupTechnologies\PicupPHPApi\Tests\Objects;

use PHPUnit\Framework\TestCase;
use PicupTechnologies\PicupPHPApi\Enums\ParcelSizeEnum;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryParcel;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryParcelCollection;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryReceiver;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryReceiverAddress;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryReceiverContact;

class DeliveryReceiverTest extends TestCase
{
    public function test() : void
    {
        $receiverAddress = new DeliveryReceiverAddress();
        $receiverContact = new DeliveryReceiverContact();
        $parcels = new DeliveryParcelCollection();
        $parcels->addParcel(new DeliveryParcel('test-ref', ParcelSizeEnum::PARCEL_MEDIUM));
        $specialInstructions = 'Go away';

        $receiver = new DeliveryReceiver($receiverAddress, $receiverContact, $parcels, $specialInstructions);

        $this->assertSame($receiverAddress, $receiver->getAddress());
        $this->assertSame($receiverContact, $receiver->getContact());
        $this->assertSame($parcels, $receiver->getParcels());
        $this->assertSame($specialInstructions, $receiver->getSpecialInstructions());
    }
}
