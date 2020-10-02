<?php

namespace CMText\RichContent\Templates\Whatsapp;

use CMText\RichContent\Messages\MediaContent;
use PHPUnit\Framework\TestCase;

class ComponentParameterDocumentTest extends TestCase
{

    public function test__construct()
    {
        $component = new ComponentParameterDocument(
            new MediaContent(
                'document name',
                'https://location',
                'application/pdf'
            )
        );

        $json = json_decode(json_encode($component));

        $this->assertAttributeEquals(
            ComponentParameterDocument::TYPE,
            'type',
            $json
        );

        $this->assertObjectHasAttribute(
            'media',
            $component
        );
    }
}
