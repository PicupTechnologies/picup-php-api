<?php

declare(strict_types=1);

namespace PicupTechnologies\PicupPHPApi\Tests\Fixtures;

use Faker\Factory;
use PicupTechnologies\PicupPHPApi\Collections\ParcelCollection;
use PicupTechnologies\PicupPHPApi\Enums\ParcelSizeEnum;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryReceiver;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryReceiverAddress;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryReceiverContact;
use PicupTechnologies\PicupPHPApi\Objects\DeliverySender;
use PicupTechnologies\PicupPHPApi\Objects\DeliverySenderAddress;
use PicupTechnologies\PicupPHPApi\Objects\DeliverySenderContact;
use PicupTechnologies\PicupPHPApi\Objects\Parcel;
use PicupTechnologies\PicupPHPApi\Objects\ParcelDimensions;
use PicupTechnologies\PicupPHPApi\Requests\DeliveryOrderRequest;

final class OrderRequestFixture
{
    public static function make() : DeliveryOrderRequest
    {
        $faker = Factory::create();

        $request = new DeliveryOrderRequest();

        $request->setIsRoundTrip($faker->boolean);
        $request->setIsForContractDriver($faker->boolean);
        $request->setScheduledDate($faker->dateTime);

        $senderAddress = new DeliverySenderAddress();
        $senderAddress->setStreetOrFarmNo($faker->buildingNumber);
        $senderAddress->setStreetOrFarm($faker->streetName);
        $senderAddress->setCity($faker->city);
        $senderAddress->setPostalCode($faker->postcode);
        $senderAddress->setSuburb($faker->city);
        $senderAddress->setLatitude($faker->latitude);
        $senderAddress->setLongitude($faker->longitude);

        $senderContact = new DeliverySenderContact();
        $senderContact->setName($faker->name);
        $senderContact->setEmail($faker->email);
        $senderContact->setTelephone($faker->phoneNumber);

        $sender = new DeliverySender($senderAddress, $senderContact);

        $request->setSender($sender);

        $receiverAddress = new DeliveryReceiverAddress();
        $receiverContact = new DeliveryReceiverContact();
        $receiverParcelCollection = new ParcelCollection();
        $receiverParcelCollection->addParcel(new Parcel(ParcelSizeEnum::PARCEL_MEDIUM, 'Medium Parcel', new ParcelDimensions(1, 2, 3), 0.0));

        $receiver = new DeliveryReceiver($receiverAddress, $receiverContact, $receiverParcelCollection, 'Knock knock');

        $request->setReceivers([$receiver]);

        return $request;
    }
}
