<?php

namespace PicupTechnologies\PicupPHPApi\Tests\Objects;

use PHPUnit\Framework\TestCase;
use PicupTechnologies\PicupPHPApi\Objects\DeliveryReceiverContact;

class DeliveryReceiverContactTest extends TestCase
{
    public function test(): void
    {
        $contact = new DeliveryReceiverContact();

        $contact->setName('Leon Schuster');
        $this->assertEquals('Leon Schuster', $contact->getName());

        $contact->setEmail('leon@schucks.co.za');
        $this->assertEquals('leon@schucks.co.za', $contact->getEmail());

        $contact->setTelephone('123');
        $this->assertEquals('123', $contact->getTelephone());

        $contact->setCellphone('444');
        $this->assertEquals('444', $contact->getCellphone());
    }
}
