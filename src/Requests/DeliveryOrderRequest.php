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

/**
 * Encapsulates a full order request for picup destined for the
 * Create/One-To-Many endpoint.
 *
 * The Create One-to-Many call will create a picup trip. The following
 * example takes a sender object and an array of receivers, with a
 * contact and address, and creates the picup as quoted for the
 * vehicle-id provided. A customer reference is also provided to help
 * with the tracking, as well as any communication provided.
 *
 * When successful you will be able to obtain the deliveryId by calling
 * $deliveryOrderResponse->getId()
 *
 * Once created, the picup's will be available for viewing at on picup
 * enterprise.
 *
 * This will also add the addresses created to the Geocoder module.
 *
 * @url http://enterprise.codependent.digital/dashboard/post-dispatch
 * @package PicupTechnologies\PicupPHPApi\Requests
 */
class DeliveryOrderRequest implements JsonSerializable
{
    private $merchantId;
    private $customerRef;
    private $vehicleId;

    /**
     * @var bool
     */
    private $isForContractDriver = false;

    /**
     * @var bool
     */
    private $isRoundTrip = false;

    /**
     * @var DateTime
     */
    private $scheduledDate;

    /**
     * @var DeliverySender
     */
    private $sender;

    /**
     * @var DeliveryReceiver[]
     */
    private $receivers;

    /**
     * @return mixed
     */
    public function getMerchantId()
    {
        return $this->merchantId;
    }

    /**
     * @param mixed $merchantId
     */
    public function setMerchantId($merchantId): void
    {
        $this->merchantId = $merchantId;
    }

    /**
     * @return mixed
     */
    public function getCustomerRef()
    {
        return $this->customerRef;
    }

    /**
     * @param mixed $customerRef
     */
    public function setCustomerRef($customerRef): void
    {
        $this->customerRef = $customerRef;
    }

    /**
     * @return mixed
     */
    public function getVehicleId()
    {
        return $this->vehicleId;
    }

    /**
     * @param mixed $vehicleId
     */
    public function setVehicleId($vehicleId): void
    {
        $this->vehicleId = $vehicleId;
    }

    /**
     * @return bool
     */
    public function isForContractDriver(): bool
    {
        return $this->isForContractDriver;
    }

    /**
     * @param bool $isForContractDriver
     */
    public function setIsForContractDriver(bool $isForContractDriver): void
    {
        $this->isForContractDriver = $isForContractDriver;
    }

    /**
     * @return bool
     */
    public function isRoundTrip(): bool
    {
        return $this->isRoundTrip;
    }

    /**
     * @param bool $isRoundTrip
     */
    public function setIsRoundTrip(bool $isRoundTrip): void
    {
        $this->isRoundTrip = $isRoundTrip;
    }

    /**
     * @return DateTime
     */
    public function getScheduledDate(): DateTime
    {
        return $this->scheduledDate;
    }

    /**
     * @param DateTime $scheduledDate
     */
    public function setScheduledDate(DateTime $scheduledDate): void
    {
        $this->scheduledDate = $scheduledDate;
    }

    /**
     * @return DeliverySender
     */
    public function getSender(): DeliverySender
    {
        return $this->sender;
    }

    /**
     * @param DeliverySender $sender
     */
    public function setSender(DeliverySender $sender): void
    {
        $this->sender = $sender;
    }

    /**
     * @return DeliveryReceiver[]
     */
    public function getReceivers(): array
    {
        return $this->receivers;
    }

    /**
     * @param DeliveryReceiver[] $receivers
     */
    public function setReceivers(array $receivers): void
    {
        $this->receivers = $receivers;
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
            'merchant_id'  => $this->merchantId,
            'customer_ref' => $this->customerRef,
            'vehicle_id'   => $this->vehicleId,

            'is_for_contract_driver'        => $this->isForContractDriver,
            'is_round_trip'                 => $this->isRoundTrip,

            'scheduled_date' => $this->scheduledDate->format('Y-m-d\TH:i:s.u\Z'),
            'sender'         => $this->sender,
            'receivers'      => $this->receivers,
        ];

        return $quote;
    }
}
