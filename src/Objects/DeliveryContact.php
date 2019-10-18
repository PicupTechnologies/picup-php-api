<?php

declare(strict_types=1);

namespace PicupTechnologies\PicupPHPApi\Objects;

use InvalidArgumentException;
use JsonSerializable;

/**
 * Class DeliveryContact
 *
 * @package PicupTechnologies\PicupPHPApi\Objects
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

    public function getName() : string
    {
        return $this->name;
    }

    public function setName(string $name) : void
    {
        $this->name = trim($name);
    }

    public function getEmail() : string
    {
        return $this->email;
    }

    public function setEmail(string $email) : void
    {
        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException(
                sprintf('%s expects valid email address, %s is not', __METHOD__, $email)
            );
        }

        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getTelephone() : ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone) : void
    {
        $this->telephone = $telephone;
    }

    /**
     * @return string
     */
    public function getCellphone() : ?string
    {
        return $this->cellphone;
    }

    public function setCellphone(string $cellphone) : void
    {
        $this->cellphone = $cellphone;
    }
}
