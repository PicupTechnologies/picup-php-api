<?php

namespace PicupTechnologies\PicupPHPApi\Requests;

use DateTime;
use JsonSerializable;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryReceiver;
use PicupTechnologies\PicupPHPApi\Objects\DeliverySender;

class DeliveryQuoteRequest implements JsonSerializable
{
    /**
     * Merchant UUID
     *
     * @var string
     */
    public $merchantId;

    /**
     * Customer Reference
     *
     * @var string
     */
    public $customerRef;

    public $isForContractDriver = false;
    public $isPreAssignTrackingNumber = false;
    public $isRoundTrip = false;
    public $userId = '';
    public $courierCosting = 'NONE';

    /**
     * Scheduled date
     *
     * @var DateTime
     */
    public $scheduledDate;

    /**
     * @var DeliverySender
     */
    public $sender;

    /**
     * @var DeliveryReceiver
     */
    public $receiver;

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
            'merchant_id'                   => $this->merchantId,
            'user_id'                       => $this->userId,
            'customer_ref'                  => $this->customerRef,
            'is_for_contract_driver'        => $this->isForContractDriver,
            'is_pre_assign_tracking_number' => $this->isPreAssignTrackingNumber,
            'is_round_trip'                 => $this->isRoundTrip,
            'scheduled_date'                => $this->scheduledDate->format('Y-m-d\TH:i:s.u\Z'),
            'courier_costing'               => $this->courierCosting,

            // quote request doesnt send a full address so we need to customize it here
            'sender'                        => [
                'address'              => [
                    'warehouse_id' => $this->sender->address->warehouseId,
                ],
                'contact'              => $this->sender->contact,
                'special_instructions' => $this->sender->specialInstructions,
            ],
            //'sender' => $this->sender,
            'receivers'                     => [$this->receiver],
        ];

        return $quote;
    }
}
