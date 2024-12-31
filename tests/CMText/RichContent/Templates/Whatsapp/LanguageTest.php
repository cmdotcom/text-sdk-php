<?php

namespace CMText\RichContent\Templates\Whatsapp;

use PHPUnit\Framework\TestCase;

class LanguageTest extends TestCase
{

    public function testJsonSerialize()
    {
        $language = new Language('nl');

        $this->assertJson(
            json_encode($language)
        );

        $this->assertTrue(
            property_exists(
                json_decode( json_encode($language) ),
                'code'
            )
        );

        $this->assertTrue(
            property_exists(
                json_decode( json_encode($language) ),
                'policy'
            )
        );
    }

    public function test__construct()
    {
        $language = new Language('nl_NL');

        $this->assertInstanceOf(
            Language::class,
            $language
        );
    }
}
