<?php

namespace CMText\RichContent\Templates\Whatsapp;

use CMText\RichContent\Messages\MediaContent;
use PHPUnit\Framework\TestCase;

class ComponentParameterImageTest extends TestCase
{

    public function test__construct()
    {
        $component = new ComponentParameterImage(
            new MediaContent(
                'image name',
                'https://location',
                'image/png'
            )
        );

        $json = json_decode(json_encode($component));

        $this->assertAttributeEquals(
            ComponentParameterImage::TYPE,
            'type',
            $json
        );

        $this->assertObjectHasAttribute(
            'media',
            $component
        );
    }
}
