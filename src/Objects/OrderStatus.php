<?php

declare(strict_types=1);

namespace PicupTechnologies\PicupPHPApi\Objects;

final class OrderStatus
{
    /**
     * @var string
     */
    private $customerReference;

    /**
     * @var string
     */
    private $orderStatus;

    /**
     * @var ParcelStatus[]
     */
    private $parcelStatuses;

    /**
     * OrderStatus constructor.
     *
     * @param ParcelStatus[] $parcelStatuses
     */
    public function __construct(string $customerReference, string $orderStatus, array $parcelStatuses)
    {
        $this->customerReference = $customerReference;
        $this->orderStatus = $orderStatus;
        $this->parcelStatuses = $parcelStatuses;
    }

    public function getCustomerReference() : string
    {
        return $this->customerReference;
    }

    public function getOrderStatus() : string
    {
        return $this->orderStatus;
    }

    /**
     * @return ParcelStatus[]
     */
    public function getParcelStatuses() : array
    {
        return $this->parcelStatuses;
    }
}
