<?php

namespace CMText\RichContent\Templates\Whatsapp;

use CMText\RichContent\Templates\TemplateContentBase;
use PHPUnit\Framework\TestCase;

class WhatsappTemplateTest extends TestCase
{

    public function testAddLocalizableParam()
    {
        $whatsappTemplate = new WhatsappTemplate(
            'my-namespace-id',
            'template-name',
            new Language('en')
        );

        $whatsappTemplate->addLocalizableParam(
            new LocalizableParamDatetime(
                'always',
                new \DateTime()
            )
        );

        $fromJson = json_decode(
            json_encode($whatsappTemplate)
        );

        $this->assertAttributeCount(
            1,
            'localizable_params',
            $fromJson->whatsapp
        );
    }

    public function test__construct()
    {
        // partial
        $whatsappTemplate = new WhatsappTemplate(
            'my-namespace-id',
            'template-name',
            new Language('en')
        );

        $this->assertInstanceOf(
            TemplateContentBase::class,
            $whatsappTemplate
        );

        // full
        $whatsappTemplate = new WhatsappTemplate(
            'my-namespace-id',
            'template-name',
            new Language('en'),
            [
                new LocalizableParamDatetime(
                    'now',
                    new \DateTime()
                ),
                new LocalizableParamDatetime(
                    'some time ago',
                    (new \DateTimeImmutable())->setTimestamp(rand(0, time()))
                ),
            ]
        );

        $this->assertInstanceOf(
            TemplateContentBase::class,
            $whatsappTemplate
        );
    }
}
