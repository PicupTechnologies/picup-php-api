<?php

declare(strict_types=1);

namespace PicupTechnologies\PicupPHPApi\Tests\Fixtures;

use Faker\Factory;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryBucket\DeliveryBucketDetails;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryBucket\DeliveryShipment;
use PicupTechnologies\PicupPHPApi\Requests\DeliveryBucketRequest;

final class DeliveryBucketRequestFixture
{
    public static function make() : DeliveryBucketRequest
    {
        $faker = Factory::create();

        $bucket = new DeliveryBucketRequest();

        $bucketDetails = new DeliveryBucketDetails();
        $bucketDetails->setWarehouseId('warehouse-' . $faker->uuid);
        $bucketDetails->setWarehouseName($faker->company);

        $bucketDetails->setDeliveryDate($faker->dateTime);
        $bucketDetails->setShiftStart($faker->dateTime);
        $bucketDetails->setShiftEnd($faker->dateTime);

        $bucket->setBucketDetails($bucketDetails);

        $shipment = new DeliveryShipment();
        $shipment->setConsignment('consignment-555');
        $shipment->setBusinessReference('business-ref-444');

        $bucket->setShipments([$shipment]);

        return $bucket;
    }
}
