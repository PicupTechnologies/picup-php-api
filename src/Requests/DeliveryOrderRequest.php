<?php
/**
 * Created by PhpStorm.
 * User: bryan
 * Date: 2018/10/23
 * Time: 2:45 PM
 */

namespace PicupTechnologies\PicupPHPApi\Requests;

use DateTime;
use JsonSerializable;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryParcelCollection;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryReceiver;
use PicupTechnologies\PicupPHPApi\Objects\DeliverySender;

class DeliveryOrderRequest implements JsonSerializable
{
    public $merchantId;
    public $customerRef;
    public $vehicleId;

    /**
     * @var bool
     */
    public $isForContractDriver;

    /**
     * @var bool
     */
    public $isPreAssignTrackingNumber = false;

    /**
     * @var bool
     */
    public $isRoundTrip = false;

    /**
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
     * @var DeliveryParcelCollection
     */
    public $parcels;

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
            'merchant_id'  => $this->merchantId,
            'customer_ref' => $this->customerRef,
            'vehicle_id'   => $this->vehicleId,

            'is_for_contract_driver'        => $this->isForContractDriver,
            'is_pre_assign_tracking_number' => $this->isPreAssignTrackingNumber,
            'is_round_trip'                 => $this->isRoundTrip,

            'scheduled_date' => $this->scheduledDate->format('Y-m-d\TH:i:s.u\Z'),
            'sender'         => $this->sender,
            'receiver'       => $this->receiver,
            'parcels'        => $this->parcels->getParcels(),
        ];

        return $quote;
    }
}
