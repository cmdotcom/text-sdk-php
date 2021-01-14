<?php

namespace CMText\RichContent\Templates\Whatsapp;

use PHPUnit\Framework\TestCase;

class ComponentButtonUrlTest extends TestCase
{

    public function test__construct()
    {
        $component = new ComponentButtonUrl(
            1,
            new ComponentParameterText('https://cm.com/')
        );

        $json = json_decode(json_encode($component));

        $this->assertEquals(
            'url',
            $json->sub_type
        );

        $this->assertCount(
            1,
            $json->parameters
        );
    }
}
