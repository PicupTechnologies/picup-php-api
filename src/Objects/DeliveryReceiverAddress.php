<?php
/**
 * Created by PhpStorm.
 * User: bryan
 * Date: 2019/03/18
 * Time: 1:06 PM
 */

namespace PicupTechnologies\PicupPHPApi\Objects;

use JsonSerializable;

class DeliveryReceiverAddress extends DeliveryAddress implements JsonSerializable
{
    /**
     * Specify data which should be serialized to JSON
     *
     * @link  https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize(): array
    {
        return parent::jsonSerialize();
    }
}
