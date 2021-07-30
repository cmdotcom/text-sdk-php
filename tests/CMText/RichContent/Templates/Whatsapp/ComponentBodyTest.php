<?php

namespace CMText\RichContent\Templates\Whatsapp;

use CMText\Exceptions\WhatsappTemplateComponentParameterTypeException;
use CMText\RichContent\Messages\MediaContent;
use PHPUnit\Framework\TestCase;

class ComponentBodyTest extends TestCase
{

    public function test__construct()
    {
        $component = new ComponentBody();

        $json = json_decode(json_encode($component));

        $this->assertEquals(
            ComponentBody::TYPE,
            $json->type
        );

        $this->assertCount(
            0,
            $json->parameters
        );
    }

    public function testUnsupportedParameterType()
    {
        $this->expectException(
            WhatsappTemplateComponentParameterTypeException::class
        );

        new ComponentBody([
            new ComponentParameterImage(
                new MediaContent(
                    'test','test','test'
                )
            ),
        ]);
    }
}
