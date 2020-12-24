<?php

namespace CMText\RichContent\Common;

use CMText\Exceptions\ContactUrlException;
use PHPUnit\Framework\TestCase;

class ContactUrlTest extends TestCase
{

    public function testJsonSerialize()
    {
        $this->assertJson( json_encode(new ContactUrl('https://cm.com')) );
    }

    public function test__construct()
    {
        // partial
        $this->assertInstanceOf(
            ContactUrl::class,
            new ContactUrl('https://cm.com')
        );

        // full
        $this->assertInstanceOf(
            ContactUrl::class,
            new ContactUrl('https://cm.com', 'AWESOME')
        );
    }

    public function testContactUrlException()
    {
        $this->expectException(ContactUrlException::class);
        new ContactUrl(__LINE__);
    }
}
