<?php

declare(strict_types=1);

namespace PicupTechnologies\PicupPHPApi\Objects;

final class DeliveryEvent
{
    private $customerReference;
    private $status;
    private $timestamp;
    private $picupIp;
    private $parcels;
    private $driverId;
    private $signatureUrl;
    private $scheduledDate;
    private $driverName;
    private $driverPhone;
    private $driverVehicleType;
}
