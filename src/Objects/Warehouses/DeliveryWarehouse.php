<?php

declare(strict_types=1);

namespace PicupTechnologies\PicupPHPApi\Objects\Warehouses;

/**
 * Class DeliveryWarehouse
 */
class DeliveryWarehouse
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
