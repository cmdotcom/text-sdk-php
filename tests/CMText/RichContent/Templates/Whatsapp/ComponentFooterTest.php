<?php

namespace CMText\RichContent\Templates\Whatsapp;

use PHPUnit\Framework\TestCase;

class ComponentFooterTest extends TestCase
{

    public function test__construct()
    {
        $component = new ComponentFooter();

        $json = json_decode(json_encode($component));

        $this->assertAttributeEquals(
            ComponentFooter::TYPE,
            'type',
            $json
        );

        $this->assertCount(
            0,
            $json->parameters
        );
    }
}
