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
class DeliveryParcel implements \JsonSerializable
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
            'reference' => $this->reference,
            'size' => $this->size
        ];
    }
}
