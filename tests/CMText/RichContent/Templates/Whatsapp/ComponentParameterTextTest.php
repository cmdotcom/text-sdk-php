<?php

namespace CMText\RichContent\Templates\Whatsapp;

use CMText\RichContent\Messages\MediaContent;
use PHPUnit\Framework\TestCase;

class ComponentParameterTextTest extends TestCase
{

    public function test__construct()
    {
        $component = new ComponentParameterText('the text');

        $json = json_decode(json_encode($component));

        $this->assertAttributeEquals(
            ComponentParameterText::TYPE,
            'type',
            $json
        );

        $this->assertObjectHasAttribute(
            'text',
            $component
        );
    }
}
