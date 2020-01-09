<?php

namespace CMText\RichContent\Common;

use PHPUnit\Framework\TestCase;

class ContactOrganizationTest extends TestCase
{

    public function testJsonSerialize()
    {
        $this->assertJson( json_encode(new ContactOrganization()) );
    }

    public function test__construct()
    {
        // empty
        $this->assertInstanceOf(
            ContactOrganization::class,
            new ContactOrganization()
        );

        // partial
        $this->assertInstanceOf(
            ContactOrganization::class,
            new ContactOrganization('CM.com', 'Development')
        );

        // full
        $this->assertInstanceOf(
            ContactOrganization::class,
            new ContactOrganization('CM.com', 'Development', 'Developer')
        );
    }
}
