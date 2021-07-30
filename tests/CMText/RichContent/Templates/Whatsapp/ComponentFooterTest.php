<?php

namespace CMText\RichContent\Templates\Whatsapp;

use PHPUnit\Framework\TestCase;

class ComponentFooterTest extends TestCase
{

    public function test__construct()
    {
        $component = new ComponentFooter();

        $json = json_decode(json_encode($component));

        $this->assertEquals(
            ComponentFooter::TYPE,
            $json->type
        );

        $this->assertCount(
            0,
            $json->parameters
        );
    }
}
