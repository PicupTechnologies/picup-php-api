<?php

declare(strict_types=1);


namespace PicupTechnologies\PicupPHPApi\Responses;

/**
 * Contains the BucketId returned by Picup after
 * creating a DeliveryBucket
 *
 * @package PicupTechnologies\PicupPHPApi\Responses
 */
final class DeliveryBucketResponse
{
    private $requestId;

    /**
     * DeliveryOrderResponse constructor.
     *
     * @param int $requestId
     */
    public function __construct(int $requestId)
    {
        $this->requestId = $requestId;
    }

    public function getId() : ?int
    {
        return $this->requestId;
    }
}
