<?php

namespace CMText\RichContent\Templates\Whatsapp;

use PHPUnit\Framework\TestCase;

class ComponentHeaderTest extends TestCase
{

    public function test__construct()
    {
        $component = new ComponentHeader();

        $json = json_decode(json_encode($component));

        $this->assertAttributeEquals(
            ComponentHeader::TYPE,
            'type',
            $json
        );

        $this->assertCount(
            0,
            $json->parameters
        );
    }
}
