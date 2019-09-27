<?php
/**
 * Created by PhpStorm.
 * User: bryan
 * Date: 2018/10/22
 * Time: 5:23 PM
 */

namespace PicupTechnologies\PicupPHPApi\Objects;

/**
 * Class DeliveryParcel
 *
 * Represents a single parcel in a delivery quote
 *
 * @package App\Domains\Delivery\DeliveryOrderQuoteRequest
 */
class DeliveryParcel
{
    /**
     * @var string
     */
    private $reference;

    /**
     * @var string
     */
    private $size;

    /**
     * DeliveryParcel constructor.
     *
     * @param string $reference
     * @param string $size
     */
    public function __construct(string $reference, string $size)
    {
        $this->reference = $reference;
        $this->size = $size;
    }

    /**
     * @return string
     */
    public function getReference(): string
    {
        return $this->reference;
    }

    /**
     * @return string
     */
    public function getSize(): string
    {
        return $this->size;
    }
}
