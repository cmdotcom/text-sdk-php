<?php

namespace CMText\RichContent\Messages;

use CMText\RichContent\Templates\Whatsapp\Language;
use CMText\RichContent\Templates\Whatsapp\ComponentParameterCurrency;
use CMText\RichContent\Templates\Whatsapp\WhatsappTemplate;
use PHPUnit\Framework\TestCase;

class TemplateMessageTest extends TestCase
{

    public function testJsonSerialize()
    {
        $template = new TemplateMessage(
            new WhatsappTemplate(
                'name-space',
                'element-name',
                new Language('nl'),
                [
                    new ComponentParameterCurrency(
                        'free',
                        'USD',
                        0.0
                    )
                ]
            )
        );

        $this->assertJson( json_encode($template) );
    }

    public function test__construct()
    {
        $template = new TemplateMessage(
            new WhatsappTemplate(
                'name-space',
                'element-name',
                new Language('nl'),
                [
                    new ComponentParameterCurrency(
                        'Two Benjamins',
                        'USD',
                        200000
                    )
                ]
            )
        );

        $this->assertInstanceOf(
            IRichMessage::class,
            $template
        );
    }
}
