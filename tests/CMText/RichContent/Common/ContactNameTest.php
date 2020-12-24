<?php

namespace CMText\RichContent\Common;

use PHPUnit\Framework\TestCase;

class ContactNameTest extends TestCase
{

    public function testJsonSerialize()
    {
        $this->assertJson( json_encode(new ContactName('CM.com Be part of it.')) );
    }

    public function test__construct()
    {
        // partial
        $this->assertInstanceOf(
            ContactName::class,
            new ContactName('CM.com Be part of it.', 'CM.com', 'Be part of it')
        );

        // full
        $this->assertInstanceOf(
            ContactName::class,
            new ContactName('CM.com Be part of it.', 'CM.com', 'Be part of it', '=', '+', '-')
        );
    }

    public function testTypeErrorRequiredProperty()
    {
        $this->expectException(\TypeError::class);
        new ContactName(null);
    }
}
