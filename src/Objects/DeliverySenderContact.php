<?php
/**
 * Created by PhpStorm.
 * User: bryan
 * Date: 2018/10/22
 * Time: 5:12 PM
 */

namespace PicupTechnologies\PicupPHPApi\Objects;

class DeliverySenderContact extends DeliveryContact
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
