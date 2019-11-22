<?php

namespace PicupTechnologies\PicupPHPApi\Objects\ThirdParty;

use DateTime;
use JsonSerializable;
use Money\Currencies\ISOCurrencies;
use Money\Formatter\DecimalMoneyFormatter;
use Money\Money;

final class ThirdPartyServicePrice implements JsonSerializable
{
    /**
     * @var int
     */
    private $serviceType;

    /**
     * @var string
     */
    private $serviceTypeDescription;

    /**
     * @var Money
     */
    private $exVat;

    /**
     * @var Money
     */
    private $vat;

    /**
     * @var Money
     */
    private $incVat;

    /**
     * @var DateTime
     */
    private $deliverDate;

    /**
     * @var int
     */
    private $timeIndicator;

    /**
     * @var DateTime
     */
    private $collectionTime;

    /**
     * @var DateTime
     */
    private $deliveryTime;

    /**
     * @var bool
     */
    private $success;

    /**
     * @var bool
     */
    private $internalError;

    /**
     * @var ?string
     */
    private $error;

    /**
     * @return int
     */
    public function getServiceType(): int
    {
        return $this->serviceType;
    }

    /**
     * @param int $serviceType
     */
    public function setServiceType(int $serviceType): void
    {
        $this->serviceType = $serviceType;
    }

    /**
     * @return string
     */
    public function getServiceTypeDescription(): string
    {
        return $this->serviceTypeDescription;
    }

    /**
     * @param string $serviceTypeDescription
     */
    public function setServiceTypeDescription(string $serviceTypeDescription): void
    {
        $this->serviceTypeDescription = $serviceTypeDescription;
    }

    /**
     * @return Money
     */
    public function getExVat(): Money
    {
        return $this->exVat;
    }

    /**
     * @param Money $exVat
     */
    public function setExVat(Money $exVat): void
    {
        $this->exVat = $exVat;
    }

    /**
     * @return Money
     */
    public function getVat(): Money
    {
        return $this->vat;
    }

    /**
     * @param Money $vat
     */
    public function setVat(Money $vat): void
    {
        $this->vat = $vat;
    }

    /**
     * @return Money
     */
    public function getIncVat(): Money
    {
        return $this->incVat;
    }

    /**
     * @param Money $incVat
     */
    public function setIncVat(Money $incVat): void
    {
        $this->incVat = $incVat;
    }

    /**
     * @return DateTime
     */
    public function getDeliverDate(): DateTime
    {
        return $this->deliverDate;
    }

    /**
     * @param DateTime $deliverDate
     */
    public function setDeliverDate(DateTime $deliverDate): void
    {
        $this->deliverDate = $deliverDate;
    }

    /**
     * @return int
     */
    public function getTimeIndicator(): int
    {
        return $this->timeIndicator;
    }

    /**
     * @param int $timeIndicator
     */
    public function setTimeIndicator(int $timeIndicator): void
    {
        $this->timeIndicator = $timeIndicator;
    }

    /**
     * @return DateTime
     */
    public function getCollectionTime(): DateTime
    {
        return $this->collectionTime;
    }

    /**
     * @param DateTime $collectionTime
     */
    public function setCollectionTime(DateTime $collectionTime): void
    {
        $this->collectionTime = $collectionTime;
    }

    /**
     * @return DateTime
     */
    public function getDeliveryTime(): DateTime
    {
        return $this->deliveryTime;
    }

    /**
     * @param DateTime $deliveryTime
     */
    public function setDeliveryTime(DateTime $deliveryTime): void
    {
        $this->deliveryTime = $deliveryTime;
    }

    /**
     * @return bool
     */
    public function isSuccess(): bool
    {
        return $this->success;
    }

    /**
     * @param bool $success
     */
    public function setSuccess(bool $success): void
    {
        $this->success = $success;
    }

    /**
     * @return bool
     */
    public function isInternalError(): bool
    {
        return $this->internalError;
    }

    /**
     * @param bool $internalError
     */
    public function setInternalError(bool $internalError): void
    {
        $this->internalError = $internalError;
    }

    /**
     * @return string|null
     */
    public function getError(): ?string
    {
        return $this->error;
    }

    /**
     * @param mixed $error
     */
    public function setError($error): void
    {
        $this->error = $error;
    }

    /**
     * Specify data which should be serialized to JSON
     *
     * @link  https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        $currencies = new ISOCurrencies();
        $moneyFormatter = new DecimalMoneyFormatter($currencies);

        return [
            'service_type' => $this->getServiceType(),
            'service_type_description' => $this->getServiceTypeDescription(),
            'ex_vat' => $moneyFormatter->format($this->getExVat()),
            'vat' => $moneyFormatter->format($this->getVat()),
            'inc_vat' => $moneyFormatter->format($this->getIncVat()),
            'deliver_date' => $this->getDeliverDate()->format('Y-m-d\TH:i:s\Z'),
            'time_indicator' => $this->getTimeIndicator(),
            'collection_time_unix_epoch' => $this->getCollectionTime()->format('U'),
            'delivery_time_unix_epoch' => $this->getDeliveryTime()->format('U'),
            'success' => $this->isSuccess(),
            'internal_error' => $this->isInternalError(),
            'error' => $this->getError()
        ];
    }
}
