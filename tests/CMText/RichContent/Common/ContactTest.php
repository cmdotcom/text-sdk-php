<?php

namespace CMText\RichContent\Common;

use CMText\Exceptions\ContactException;
use PHPUnit\Framework\TestCase;

class ContactTest extends TestCase
{
    private $contactProperties = [];

    public function __construct($name = null, array $data = array(), $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        // set up all the Contact properties
        $this->contactProperties['address'] = new \CMText\RichContent\Common\ContactAddress('Breda', 'Netherlands', 'NL');
        $this->contactProperties['birthday'] = new \CMText\RichContent\Common\ContactBirthday( new \DateTime() );
        $this->contactProperties['email'] = new \CMText\RichContent\Common\ContactEmail('info@cm.com');
        $this->contactProperties['name'] = new \CMText\RichContent\Common\ContactName('CM.com Be part of it.');
        $this->contactProperties['organization'] = new \CMText\RichContent\Common\ContactOrganization('CM.com', 'Development');
        $this->contactProperties['phonenumber'] = new \CMText\RichContent\Common\ContactPhonenumber('+31765727000');
        $this->contactProperties['url'] = new \CMText\RichContent\Common\ContactUrl('https://cm.com');
    }

    public function testJsonSerialize()
    {
        $this->assertJson( json_encode(new Contact()) );
    }

    public function testAddUrl()
    {
        $this->assertTrue(
            property_exists(
                (new Contact(
                    $this->contactProperties['url']
                ))->jsonSerialize(),
                'urls'
            )
        );
    }

    public function testAddPhonenumber()
    {
        $this->assertTrue(
            property_exists(
                (new Contact(
                    $this->contactProperties['phonenumber']
                ))->jsonSerialize(),
                'phones'
            )
        );
    }

    public function testSetOrganization()
    {
        $this->assertTrue(
            property_exists(
                (new Contact(
                    $this->contactProperties['organization']
                ))->jsonSerialize(),
                'org'
            )
        );
    }

    public function test__construct()
    {
        // empty Contact initialization
        $this->assertInstanceOf(
            Contact::class,
            new Contact()
        );

        // partial Contact initialization
        $this->assertInstanceOf(
            Contact::class,
            new Contact(
                $this->contactProperties['birthday'],
                [
                    $this->contactProperties['url'],
                    $this->contactProperties['url'],
                ]
            )
        );

        // full Contact initialization
        $this->assertInstanceOf(
            Contact::class,
            new Contact(
                $this->contactProperties['address'],
                $this->contactProperties['birthday'],
                $this->contactProperties['email'],
                $this->contactProperties['name'],
                $this->contactProperties['organization'],
                $this->contactProperties['phonenumber'],
                $this->contactProperties['url']
            )
        );
    }

    public function testSetBirthday()
    {
        $this->assertTrue(
            property_exists(
                (new Contact(
                    $this->contactProperties['birthday']
                ))->jsonSerialize(),
                'birthday'
            )
        );
    }

    public function testSetName()
    {
        $this->assertTrue(
            property_exists(
                (new Contact(
                    $this->contactProperties['name']
                ))->jsonSerialize(),
                'name'
            )
        );
    }

    public function testAddEmail()
    {
        $this->assertTrue(
            property_exists(
                (new Contact(
                    $this->contactProperties['email']
                ))->jsonSerialize(),
                'emails'
            )
        );
    }

    public function testAddAddress()
    {
        $this->assertTrue(
            property_exists(
                (new Contact(
                    $this->contactProperties['address']
                ))->jsonSerialize(),
                'addresses'
            )
        );
    }

    public function testContactException()
    {
        $this->expectException(ContactException::class);
        new Contact('just a string');
    }
}
