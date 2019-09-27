<?php

namespace PicupTechnologies\PicupPHPApi\Tests\Fixtures;

use Faker\Factory;
use PicupTechnologies\PicupPHPApi\Enums\ParcelSizeEnum;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryParcel;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryParcelCollection;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryReceiver;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryReceiverAddress;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryReceiverContact;
use PicupTechnologies\PicupPHPApi\Objects\DeliverySender;
use PicupTechnologies\PicupPHPApi\Objects\DeliverySenderAddress;
use PicupTechnologies\PicupPHPApi\Objects\DeliverySenderContact;
use PicupTechnologies\PicupPHPApi\Requests\DeliveryOrderRequest;

final class OrderRequestFixture
{
    public static function make(): DeliveryOrderRequest
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

        $collection = new DeliveryParcelCollection();
        $collection->addParcel(new DeliveryParcel('parcel-ref', ParcelSizeEnum::PARCEL_MEDIUM));

        $receiverAddress = new DeliveryReceiverAddress();
        $receiverContact = new DeliveryReceiverContact();
        $receiverParcels = new DeliveryParcelCollection();
        $receiverParcels->addParcel(new DeliveryParcel('123', 'parcel-large'));

        $receiver = new DeliveryReceiver($receiverAddress, $receiverContact, $receiverParcels, 'Knock knock');

        $request->setReceivers([$receiver]);
        return $request;
    }
}
