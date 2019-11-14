<?php

namespace PicupTechnologies\PicupPHPApi\Objects\ThirdParty;

use JsonSerializable;

final class ThirdPartyCourier implements JsonSerializable
{
    /**
     * @var int
     */
    private $courier;

    /**
     * @var string
     */
    private $courierCode;

    /**
     * @var string
     */
    private $courierName;

    /**
     * @var ThirdPartyServicePriceCollection
     */
    private $servicePrices;

    /**
     * @var int
     */
    private $totalQuotes;

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
    public function getCourier(): int
    {
        return $this->courier;
    }

    /**
     * @param int $courier
     */
    public function setCourier(int $courier): void
    {
        $this->courier = $courier;
    }

    /**
     * @return string
     */
    public function getCourierCode(): string
    {
        return $this->courierCode;
    }

    /**
     * @param string $courierCode
     */
    public function setCourierCode(string $courierCode): void
    {
        $this->courierCode = $courierCode;
    }

    /**
     * @return string
     */
    public function getCourierName(): string
    {
        return $this->courierName;
    }

    /**
     * @param string $courierName
     */
    public function setCourierName(string $courierName): void
    {
        $this->courierName = $courierName;
    }

    /**
     * @return ThirdPartyServicePriceCollection|null
     */
    public function getServicePrices(): ?ThirdPartyServicePriceCollection
    {
        return $this->servicePrices;
    }

    /**
     * @param ThirdPartyServicePriceCollection $servicePrices
     */
    public function setServicePrices(ThirdPartyServicePriceCollection $servicePrices): void
    {
        $this->servicePrices = $servicePrices;
    }

    /**
     * @return int
     */
    public function getTotalQuotes(): int
    {
        return $this->totalQuotes;
    }

    /**
     * @param int $totalQuotes
     */
    public function setTotalQuotes(int $totalQuotes): void
    {
        $this->totalQuotes = $totalQuotes;
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
     * @param null|string $error
     */
    public function setError(?string $error): void
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
        return [
            'courier' => $this->getCourier(),
            'courier_code' => $this->getCourierCode(),
            'courier_name' => $this->getCourierName(),
            'service_prices' => $this->getServicePrices(),
            'total_quotes' => $this->getTotalQuotes(),
            'success' => $this->isSuccess(),
            'internal_error' => $this->isInternalError(),
            'error' => $this->getError()
        ];
    }
}
