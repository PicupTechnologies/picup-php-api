<?php

declare(strict_types=1);

namespace PicupTechnologies\PicupPHPApi\Objects\Warehouses;

/**
 * Class DeliveryWarehouse
 *
 * @package PicupTechnologies\PicupPHPApi\Objects\Warehouses
 */
final class DeliveryWarehouse
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * DeliveryWarehouse constructor.
     *
     * @param string $id
     * @param string $name
     */
    public function __construct(string $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function getId() : string
    {
        return $this->id;
    }

    public function getName() : string
    {
        return $this->name;
    }
}
