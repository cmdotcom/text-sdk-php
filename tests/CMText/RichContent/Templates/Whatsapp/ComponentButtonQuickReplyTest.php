<?php

namespace CMText\RichContent\Templates\Whatsapp;

use PHPUnit\Framework\TestCase;

class ComponentButtonQuickReplyTest extends TestCase
{

    public function test__construct()
    {
        $component = new ComponentButtonQuickReply(
            1,
            new ComponentParameterPayload('test payload')
        );

        $json = json_decode(json_encode($component));

        $this->assertEquals(
            'quick_reply',
            $json->sub_type
        );

        $this->assertCount(
            1,
            $json->parameters
        );
    }
}
