<?php

namespace CMText\RichContent\Common;

use CMText\Exceptions\ContactPhonenumberException;
use PHPUnit\Framework\TestCase;

class ContactPhonenumberTest extends TestCase
{

    public function test__construct()
    {
        $this->assertJson( json_encode(new ContactPhonenumber()) );
    }

    public function testJsonSerialize()
    {
        // empty
        $this->assertInstanceOf(
            ContactPhonenumber::class,
            new ContactPhonenumber()
        );

        // partial
        $this->assertInstanceOf(
            ContactPhonenumber::class,
            new ContactPhonenumber('+31765727000')
        );

        // full
        $this->assertInstanceOf(
            ContactPhonenumber::class,
            new ContactPhonenumber('+31765727000', ContactPhonenumberTypes::MAIN)
        );
    }

    public function testContactPhonenumberTypeException()
    {
        $this->expectException(ContactPhonenumberException::class);
        new ContactPhonenumber('+31765727000', 'EXCEPTIONAL');
    }
}
