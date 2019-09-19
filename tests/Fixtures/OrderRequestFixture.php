<?php

namespace PicupTechnologies\PicupPHPApi\Tests\Fixtures;

use Faker\Factory;
use PicupTechnologies\PicupPHPApi\Enums\ParcelSizeEnum;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryParcel;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryParcelCollection;
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

        $request->isRoundTrip = $faker->boolean;
        $request->isForContractDriver = $faker->boolean;
        $request->isPreAssignTrackingNumber = $faker->boolean;
        $request->scheduledDate = $faker->dateTime;

        $senderAddress = new DeliverySenderAddress();
        $senderAddress->street_or_farm_no = $faker->buildingNumber;
        $senderAddress->street_or_farm = $faker->streetName;
        $senderAddress->city = $faker->city;
        $senderAddress->postal_code = $faker->postcode;
        $senderAddress->suburb = $faker->city;
        $senderAddress->latitude = $faker->latitude;
        $senderAddress->longitude = $faker->longitude;

        $senderContact = new DeliverySenderContact();
        $senderContact->name = $faker->name;
        $senderContact->email = $faker->email;
        $senderContact->telephone = $faker->phoneNumber;

        $sender = new DeliverySender($senderAddress, $senderContact);

        $request->sender = $sender;

        $collection = new DeliveryParcelCollection();
        $collection->addParcel(new DeliveryParcel('parcel-ref', ParcelSizeEnum::PARCEL_MEDIUM));

        $request->parcels = $collection;

        return $request;
    }
}
