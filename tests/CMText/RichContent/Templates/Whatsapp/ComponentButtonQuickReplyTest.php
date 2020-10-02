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

        $this->assertAttributeEquals(
            'quick_reply',
            'sub_type',
            $json
        );

        $this->assertAttributeCount(
            1,
            'parameters',
            $json
        );
    }
}
