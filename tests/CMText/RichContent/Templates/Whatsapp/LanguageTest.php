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

        $this->assertObjectHasAttribute(
            'code',
            json_decode( json_encode($language) )
        );

        $this->assertObjectHasAttribute(
            'policy',
            json_decode( json_encode($language) )
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
