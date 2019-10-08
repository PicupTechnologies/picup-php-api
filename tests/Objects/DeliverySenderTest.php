<?php

declare(strict_types=1);

namespace PicupTechnologies\PicupPHPApi\Tests\Objects;

use PHPUnit\Framework\TestCase;
use PicupTechnologies\PicupPHPApi\Enums\ParcelSizeEnum;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryParcel;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryParcelCollection;
use PicupTechnologies\PicupPHPApi\Objects\DeliverySender;
use PicupTechnologies\PicupPHPApi\Objects\DeliverySenderAddress;
use PicupTechnologies\PicupPHPApi\Objects\DeliverySenderContact;

class DeliverySenderTest extends TestCase
{
    public function testBasics() : void
    {
        $receiverAddress = new DeliverySenderAddress();
        $receiverContact = new DeliverySenderContact();
        $parcels = new DeliveryParcelCollection();
        $parcels->addParcel(new DeliveryParcel('test-ref', ParcelSizeEnum::PARCEL_MEDIUM));
        $specialInstructions = 'Go away';

        $receiver = new DeliverySender($receiverAddress, $receiverContact, $specialInstructions);

        $this->assertSame($receiverAddress, $receiver->getAddress());
        $this->assertSame($receiverContact, $receiver->getContact());
        $this->assertSame($specialInstructions, $receiver->getSpecialInstructions());
    }
}
