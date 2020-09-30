<?php

namespace CMText\RichContent\Templates\Whatsapp;

use CMText\RichContent\Messages\MediaContent;
use PHPUnit\Framework\TestCase;

class ComponentParameterVideoTest extends TestCase
{

    public function test__construct()
    {
        $component = new ComponentParameterVideo(
            new MediaContent(
                'video name',
                'https://location',
                'video/mp4'
            )
        );

        $json = json_decode(json_encode($component));

        $this->assertAttributeEquals(
            ComponentParameterVideo::TYPE,
            'type',
            $json
        );

        $this->assertObjectHasAttribute(
            'media',
            $component
        );
    }
}
