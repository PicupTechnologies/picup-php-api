<?php

declare(strict_types=1);

namespace PicupTechnologies\PicupPHPApi\Tests\Factories;

use PHPUnit\Framework\TestCase;
use PicupTechnologies\PicupPHPApi\Factories\OrderStatusResponseFactory;

class OrderStatusResponseFactoryTest extends TestCase
{
    public function testMake() : void
    {
        $customerRef = 'ref-123';
        $orderStatusText = 'Pending Delivery';
        $parcelReference = 'parcel-444';
        $parcelTracking = 'tracking-444';
        $parcelStatus = 'Pending Collection';

        $body = [
            [
                'customer_reference' => $customerRef,
                'order_status' => $orderStatusText,
                'parcel_statuses' => [
                    [
                        'reference' => $parcelReference,
                        'tracking_number' => $parcelTracking,
                        'status' => $parcelStatus
                    ]
                ]
            ]
        ];

        $response = OrderStatusResponseFactory::make($body);

        $orderStatus = $response->getOrderStatuses()[0];

        $this->assertSame($customerRef, $orderStatus->getCustomerReference());
        $this->assertSame($orderStatusText, $orderStatus->getOrderStatus());

        $parcel = $orderStatus->getParcelStatuses()[0];

        $this->assertSame($parcelReference, $parcel->getReference());
        $this->assertSame($parcelTracking, $parcel->getTrackingNumber());
        $this->assertSame($parcelStatus, $parcel->getStatus());
    }
}
