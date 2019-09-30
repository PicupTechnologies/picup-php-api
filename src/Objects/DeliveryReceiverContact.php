<?php
/**
 * Created by PhpStorm.
 * User: bryan
 * Date: 2019/03/18
 * Time: 1:08 PM
 */

namespace PicupTechnologies\PicupPHPApi\Objects;

class DeliveryReceiverContact extends DeliveryContact
{
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
            'name' => $this->getName(),
            'email' => $this->getEmail(),
            'telephone' => $this->getTelephone(),
            'cellphone' => $this->getCellphone()
        ];
    }
}
