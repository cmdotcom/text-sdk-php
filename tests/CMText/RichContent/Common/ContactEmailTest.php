<?php

namespace CMText\RichContent\Common;

use CMText\Exceptions\ContactEmailException;
use PHPUnit\Framework\TestCase;

class ContactEmailTest extends TestCase
{

    public function test__construct()
    {
        $this->assertInstanceOf(
            ContactEmail::class,
            new ContactEmail('text-sdk-php@cm.com')
        );

        $this->assertInstanceOf(
            ContactEmail::class,
            new ContactEmail('text-sdk-php@cm.com', ContactEmailTypes::WORK)
        );
    }

    public function testJsonSerialize()
    {
        $this->assertJson(
            json_encode(new ContactEmail('text-sdk-php@cm.com'))
        );
    }

    public function testInvalidEmailException()
    {
        $this->expectException(ContactEmailException::class);
        new ContactEmail(__LINE__);
    }

    public function testContactEmailTypeException()
    {
        $this->expectException(ContactEmailException::class);
        new ContactEmail('text-sdk-php@cm.com', 'EXCEPTIONAL');
    }
}
