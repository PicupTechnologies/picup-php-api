<?php

declare(strict_types=1);

namespace PicupTechnologies\PicupPHPApi\Tests\Objects;

use PHPUnit\Framework\TestCase;
use PicupTechnologies\PicupPHPApi\Objects\DeliverySenderContact;

class DeliverySenderContactTest extends TestCase
{
    public function test() : void
    {
        $contact = new DeliverySenderContact();

        $contact->setName('Leon Schuster');
        $this->assertSame('Leon Schuster', $contact->getName());

        $contact->setEmail('leon@schucks.co.za');
        $this->assertSame('leon@schucks.co.za', $contact->getEmail());

        $contact->setTelephone('123');
        $this->assertSame('123', $contact->getTelephone());

        $contact->setCellphone('444');
        $this->assertSame('444', $contact->getCellphone());
    }
}
