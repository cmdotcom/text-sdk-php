<?php

namespace CMText\RichContent\Templates\Whatsapp;

use PHPUnit\Framework\TestCase;

class ComponentButtonTest extends TestCase
{

    public function test__construct()
    {
        $component = new ComponentButton(
            0,
            new ComponentParameterText('test text')
        );

        $json = json_decode(json_encode($component));

        $this->assertAttributeEquals(
            ComponentButton::TYPE,
            'type',
            $json
        );

        $this->assertObjectHasAttribute(
            'index',
            $json
        );
    }
}
