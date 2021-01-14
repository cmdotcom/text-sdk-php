<?php

namespace CMText\RichContent\Templates\Whatsapp;

use PHPUnit\Framework\TestCase;

class ComponentHeaderTest extends TestCase
{

    public function test__construct()
    {
        $component = new ComponentHeader();

        $json = json_decode(json_encode($component));

        $this->assertEquals(
            ComponentHeader::TYPE,
            $json->type
        );

        $this->assertCount(
            0,
            $json->parameters
        );
    }
}
