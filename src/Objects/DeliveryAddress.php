<?php
/**
 * Created by PhpStorm.
 * User: bryan
 * Date: 2018/10/22
 * Time: 5:18 PM
 */

namespace PicupTechnologies\PicupPHPApi\Objects;

/**
 * Class DeliveryReceiverAddress
 *
 */
class DeliveryAddress
{
    /**
     * @var string
     */
    public $unit_no = '';

    /**
     * @var string
     */
    public $complex = '';

    /**
     * @var string
     */
    public $street_or_farm_no = '';

    /**
     * @var string
     */
    public $street_or_farm = '';

    /**
     * @var string
     */
    public $suburb = '';

    /**
     * @var string
     */
    public $city = '';

    /**
     * @var string
     */
    public $postal_code = '';

    /**
     * @var string
     */
    public $country = 'South Africa';

    /**
     * @var float
     */
    public $latitude = -33.918861;

    /**
     * @var float
     */
    public $longitude = 18.423300;
}
