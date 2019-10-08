<?php

declare(strict_types=1);

namespace PicupTechnologies\PicupPHPApi\Tests\Fixtures;

use Faker\Factory;
use PicupTechnologies\PicupPHPApi\Objects\DeliverySender;
use PicupTechnologies\PicupPHPApi\Objects\DeliverySenderAddress;
use PicupTechnologies\PicupPHPApi\Objects\DeliverySenderContact;
use PicupTechnologies\PicupPHPApi\Requests\DeliveryQuoteRequest;

class QuoteRequestFixture
{
    public static function make() : DeliveryQuoteRequest
    {
        $faker = Factory::create();

        $request = new DeliveryQuoteRequest();

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

        return $request;
    }
}
