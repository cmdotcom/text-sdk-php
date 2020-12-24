<?php

namespace CMText\RichContent\Common;

use PHPUnit\Framework\TestCase;

class ContactBirthdayTest extends TestCase
{

    public function testJsonSerialize()
    {
        $this->assertJson( json_encode(new ContactBirthday(new \DateTime())) );
    }

    public function test__construct()
    {
        $this->assertInstanceOf(
            ContactBirthday::class,
            new ContactBirthday(new \DateTime())
        );
    }

    public function testDateTimeInterfaceException()
    {
        $this->expectException(\TypeError::class);
        new ContactBirthday('never');
    }
}
