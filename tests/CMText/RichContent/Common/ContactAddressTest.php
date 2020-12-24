<?php

namespace CMText\RichContent\Common;

use CMText\Exceptions\ContactAddressException;
use PHPUnit\Framework\TestCase;

class ContactAddressTest extends TestCase
{

    public function testJsonSerialize()
    {
        $this->assertJson(
            json_encode(new ContactAddress('Breda', 'Netherlands', 'NL'))
        );
    }

    public function test__construct()
    {
        //empty
        $this->assertInstanceOf(
            ContactAddress::class,
            new ContactAddress()
        );

        // partial
        $this->assertInstanceOf(
            ContactAddress::class,
            new ContactAddress('Breda', 'Netherlands', 'NL')
        );

        // full
        $this->assertInstanceOf(
            ContactAddress::class,
            new ContactAddress('Breda', 'Netherlands', 'NL','Noord Brabant', 'Konijnenberg 30', ContactAddressTypes::WORK, '4825BD')
        );
    }

    public function testCountryCodeException()
    {
        // invalid country code
        $this->expectException(ContactAddressException::class);
        new ContactAddress('Breda', 'Netherlands', 'EXCEPTIONAL');
    }

    public function testAddressTypeException()
    {
        // unknown type
        $this->expectException(ContactAddressException::class);
        new ContactAddress('Breda', 'Netherlands', 'NL', 'Noord Brabant', 'Konijnenberg 30', 'EXCEPTIONAL', '4825BD');
    }
}
