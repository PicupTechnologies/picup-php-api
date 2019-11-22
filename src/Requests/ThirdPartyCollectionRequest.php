<?php

namespace PicupTechnologies\PicupPHPApi\Requests;

use JsonSerializable;
use PicupTechnologies\PicupPHPApi\Contracts\PicupRequestInterface;
use PicupTechnologies\PicupPHPApi\Objects\ThirdParty\ThirdPartyCollectionCollection;

/**
 * Contains the third party courier collection request
 *
 * @package PicupTechnologies\PicupPHPApi\Requests
 */
final class ThirdPartyCollectionRequest implements PicupRequestInterface, JsonSerializable
{
    /**
     * @var ThirdPartyCollectionCollection
     */
    private $collection;

    /**
     * @return ThirdPartyCollectionCollection
     */
    public function getCollection(): ThirdPartyCollectionCollection
    {
        return $this->collection;
    }

    /**
     * @param ThirdPartyCollectionCollection $collection
     */
    public function setCollection(ThirdPartyCollectionCollection $collection): void
    {
        $this->collection = $collection;
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
            'collection' => $this->getCollection()->getCollections()[0],
            'courier_code' => $this->getCollection()->getCourierCode(),
            'service_type' => $this->getCollection()->getServiceType()
        ];
    }
}
