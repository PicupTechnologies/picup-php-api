<?php
/**
 * Created by PhpStorm.
 * User: bryan
 * Date: 2018/10/22
 * Time: 5:22 PM
 */

namespace PicupTechnologies\PicupPHPApi\Objects;

use JsonSerializable;

/**
 * Class DeliveryReceiverContact
 *
 * @package App\Domains\Delivery\Objects
 */
abstract class DeliveryContact implements JsonSerializable
{
    /**
     * @var string
     */
    private $name = 'Receiver Name';

    /**
     * @var string
     */
    private $email = 'receiver@email.com';

    /**
     * Unused field.
     *
     * @var string
     */
    private $telephone = '';

    /**
     * @var string
     */
    private $cellphone = '';

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    /**
     * @param string $telephone
     */
    public function setTelephone(string $telephone): void
    {
        $this->telephone = $telephone;
    }

    /**
     * @return string
     */
    public function getCellphone(): ?string
    {
        return $this->cellphone;
    }

    /**
     * @param string $cellphone
     */
    public function setCellphone(string $cellphone): void
    {
        $this->cellphone = $cellphone;
    }


}
