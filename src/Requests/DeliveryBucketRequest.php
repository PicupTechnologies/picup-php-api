<?php
/**
 * Created by PhpStorm.
 * User: bryan
 * Date: 2018/10/23
 * Time: 2:45 PM
 */

namespace PicupTechnologies\PicupPHPApi\Requests;

use JsonSerializable;
use PicupTechnologies\PicupPHPApi\Contracts\PicupRequest;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryBucket\DeliveryBucketDetails;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryBucket\DeliveryShipment;

/**
 * Holds all the details for a DeliveryBucketRequest
 *
 * @package PicupTechnologies\PicupPHPApi\Requests
 */
class DeliveryBucketRequest implements PicupRequest, JsonSerializable
{
    /**
     * @var DeliveryBucketDetails
     */
    private $bucketDetails;

    /**
     * @var DeliveryShipment[]
     */
    private $shipments;

    /**
     * @return DeliveryBucketDetails
     */
    public function getBucketDetails(): DeliveryBucketDetails
    {
        return $this->bucketDetails;
    }

    /**
     * @param DeliveryBucketDetails $bucketDetails
     */
    public function setBucketDetails(DeliveryBucketDetails $bucketDetails): void
    {
        $this->bucketDetails = $bucketDetails;
    }

    /**
     * @return DeliveryShipment[]
     */
    public function getShipments(): array
    {
        return $this->shipments;
    }

    /**
     * @param DeliveryShipment[] $shipments
     */
    public function setShipments(array $shipments): void
    {
        $this->shipments = $shipments;
    }

    /**
     * Specify data which should be serialized to JSON
     *
     * @link  http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        $quote = [
            'bucket_details' => $this->bucketDetails,
            'shipments'      => $this->shipments,
        ];

        return $quote;
    }
}
