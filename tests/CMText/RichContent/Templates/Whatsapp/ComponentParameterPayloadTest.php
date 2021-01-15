<?php

namespace CMText\RichContent\Templates\Whatsapp;

use PHPUnit\Framework\TestCase;

class ComponentParameterPayloadTest extends TestCase
{

    public function test__construct()
    {
        $component = new ComponentParameterPayload('the payload');

        $json = json_decode(json_encode($component));

        $this->assertEquals(
            ComponentParameterPayload::TYPE,
            $json->type
        );

        $this->assertObjectHasAttribute(
            'payload',
            $json
        );
    }
}
