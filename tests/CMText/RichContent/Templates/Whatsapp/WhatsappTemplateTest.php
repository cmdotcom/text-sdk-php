<?php

namespace CMText\RichContent\Templates\Whatsapp;

use CMText\RichContent\Messages\MediaContent;
use CMText\RichContent\Templates\TemplateContentBase;
use PHPUnit\Framework\TestCase;

class WhatsappTemplateTest extends TestCase
{

    public function testAddComponents()
    {
        $whatsappTemplate = new WhatsappTemplate(
            'my-namespace-id',
            'template-name',
            new Language('en')
        );

        $whatsappTemplate->addComponents([
            new ComponentHeader([
                new ComponentParameterImage(
                    new MediaContent(
                        'image name',
                        'image://location',
                        'image/beautiful'
                    )
                )
            ]),
            new ComponentBody([
                new ComponentParameterText('body text')
            ]),
            new ComponentFooter([
                new ComponentParameterText('footer text')
            ]),
            new ComponentButtonQuickReply(
                0,
                new ComponentParameterPayload('🤠')
            ),
            new ComponentButtonUrl(
                1,
                new ComponentParameterText('https://cm.com/')
            )
        ]);

        $json = json_decode(
            json_encode($whatsappTemplate)
        );

        $this->assertCount(
            5,
            $json->whatsapp->components
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
                new ComponentParameterDatetime(
                    'now',
                    new \DateTime()
                ),
                new ComponentParameterDatetime(
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

    public function testTemplateWithoutComponents()
    {
        $whatsappTemplate = new WhatsappTemplate(
            'my-namespace-id',
            'template-name',
            new Language('en')
        );

        $json = json_decode(
            json_encode($whatsappTemplate)
        );
        
        $this->assertObjectHasAttribute(
            'components',
            $json->whatsapp
        );
    }
}
