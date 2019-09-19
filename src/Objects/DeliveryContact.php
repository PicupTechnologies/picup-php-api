<?php
/**
 * Created by PhpStorm.
 * User: bryan
 * Date: 2018/10/22
 * Time: 5:22 PM
 */

namespace PicupTechnologies\PicupPHPApi\Objects;

/**
 * Class DeliveryReceiverContact
 *
 * @package App\Domains\Delivery\Objects
 */
class DeliveryContact
{
    /**
     * @var string
     */
    public $name = 'Receiver Name';

    /**
     * @var string
     */
    public $email = 'receiver@email.com';

    /**
     * Unused field.
     *
     * @var string
     */
    public $telephone = '';

    /**
     * @var string
     */
    public $cellphone = '';
}
