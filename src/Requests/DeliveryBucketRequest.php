<?php

declare(strict_types=1);


namespace PicupTechnologies\PicupPHPApi\Requests;

use JsonSerializable;
use PicupTechnologies\PicupPHPApi\Contracts\PicupRequestInterface;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryBucket\DeliveryBucketDetails;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryBucket\DeliveryShipment;

/**
 * Holds all the details for a DeliveryBucketRequest
 *
 * @package PicupTechnologies\PicupPHPApi\Requests
 */
class DeliveryBucketRequest implements PicupRequestInterface, JsonSerializable
{
    /**
     * @var DeliveryBucketDetails
     */
    private $bucketDetails;

    /**
     * @var DeliveryShipment[]
     */
    private $shipments;

    public function getBucketDetails() : DeliveryBucketDetails
    {
        return $this->bucketDetails;
    }

    public function setBucketDetails(DeliveryBucketDetails $bucketDetails) : void
    {
        $this->bucketDetails = $bucketDetails;
    }

    /**
     * @return DeliveryShipment[]
     */
    public function getShipments() : array
    {
        return $this->shipments;
    }

    /**
     * @param DeliveryShipment[] $shipments
     */
    public function setShipments(array $shipments) : void
    {
        $this->shipments = $shipments;
    }

    /**
     * Specify data which should be serialized to JSON
     *
     * @see  http://php.net/manual/en/jsonserializable.jsonserialize.php
     *
     * @return mixed data which can be serialized by <b>json_encode</b>,
     *               which is a value of any type other than a resource
     *
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return [
            'bucket_details' => $this->bucketDetails,
            'shipments' => $this->shipments,
        ];
    }
}
