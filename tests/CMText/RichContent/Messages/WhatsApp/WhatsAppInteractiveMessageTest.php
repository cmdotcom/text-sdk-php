<?php

namespace CMText\RichContent\Messages\WhatsApp;

use CMText\Channels;
use CMText\Message;
use CMText\RichContent\Messages\MediaContent;
use CMText\TextClientRequest;
use PHPUnit\Framework\TestCase;

class WhatsAppInteractiveMessageTest extends TestCase
{
    public function testWhatsAppInteractiveSectionMessage()
    {
        //  test building a WhatsApp Interactive Message with Sections
        $message = new WhatsAppInteractiveMessage(
            new WhatsAppInteractiveContent(
                WhatsAppInteractiveContentTypes::LIST,
                new WhatsAppInteractiveHeader(
                    WhatsAppInteractiveHeaderTypes::TEXT,
                    'List message example'
                ),
                new WhatsAppInteractiveBody('checkout our list message demo'),
                new WhatsAppInteractiveListAction(
                    'Descriptive list title',
                    [new WhatsAppInteractiveSection(
                        'Select an option',
                        [new WhatsAppInteractiveSectionRow(
                            'unique title 1',
                            rand(),
                            'description text'
                        ),new WhatsAppInteractiveSectionRow(
                            'unique title 2',
                            rand()
                        )]
                    )]
                ),
                new WhatsAppInteractiveFooter('footer text')
            )
        );

        $this->assertInstanceOf(
            WhatsAppInteractiveMessage::class,
            $message
        );

        //  test that it still compatible with a \CMText\Message
        $CMTextMessage = new Message();
        $CMTextMessage
            ->WithChannels([Channels::WHATSAPP])
            ->WithRichMessage($message);

        $this->assertInstanceOf(
            Message::class,
            $CMTextMessage
        );

        $this->assertJson(
            json_encode($CMTextMessage)
        );
    }

    /**
     * @throws \CMText\Exceptions\RecipientLimitException
     * @throws \CMText\Exceptions\ConversationLimitException
     */
    public function testWhatsAppInteractiveButtonsMessage()
    {
        //  test building a WhatsApp Interactive Message with Buttons
        $message = new WhatsAppInteractiveMessage(
            new WhatsAppInteractiveContent(
                WhatsAppInteractiveContentTypes::BUTTON,
                new WhatsAppInteractiveHeader(
                    WhatsAppInteractiveHeaderTypes::IMAGE,
                    null,
                    new MediaContent(
                        'media name',
                        'media.url',
                        'mime/type'
                    )
                ),
                new WhatsAppInteractiveBody('checkout our list message demo'),
                new WhatsAppInteractiveButtonAction(
                    [new WhatsAppInteractiveReplyButton(
                        'button 1 reply-text',
                        rand()
                    ),new WhatsAppInteractiveReplyButton(
                        'button 2 title',
                        rand()
                    )]
                ),
                new WhatsAppInteractiveFooter('footer text')
            )
        );

        $this->assertInstanceOf(
            WhatsAppInteractiveMessage::class,
            $message
        );
    }

    public function testWhatsAppInteractiveSectionRowType()
    {
        $this->expectException(\Exception::class);

        $this->expectExceptionMessage('Unsupported Row-type : '. WhatsAppInteractiveContentTypes::class);

        new WhatsAppInteractiveSection(
            'test title',
            [
                new WhatsAppInteractiveContentTypes()
            ]
        );
    }

    public function testWhatsAppInteractiveListActionSectionType()
    {
        $this->expectException(\Exception::class);

        $this->expectExceptionMessage('Section is not a WhatsAppInteractiveSection.');

        new WhatsAppInteractiveListAction(
            'test button',
            [
                new WhatsAppInteractiveContentTypes()
            ]
        );
    }

    public function testWhatsAppInteractiveHeaderType()
    {
        $this->expectException(\Exception::class);

        $this->expectExceptionMessage('Unsupported WhatsApp-InteractiveHeader-type '. \TypeError::class);

        new WhatsAppInteractiveHeader(\TypeError::class);
    }

    public function testWhatsAppInteractiveContentType()
    {
        $this->expectException(\Exception::class);

        $this->expectExceptionMessage('Unsupported WhatsApp-InteractiveContent-type ' . \TypeError::class);

        new WhatsAppInteractiveContent(
            \TypeError::class
        );
    }

    public function testWhatsAppInteractiveContentAction()
    {
        $this->expectException(\Exception::class);

        $this->expectExceptionMessage('Action is always Required.');

        new WhatsAppInteractiveContent(
            WhatsAppInteractiveContentTypes::BUTTON
        );
    }

    public function testWhatsAppInteractiveContentProductlist()
    {
        $this->expectException(\Exception::class);

        $this->expectExceptionMessage('Header is required for type '. WhatsAppInteractiveContentTypes::PRODUCT_LIST);

        new WhatsAppInteractiveContent(
            WhatsAppInteractiveContentTypes::PRODUCT_LIST,
            null,
            null,
            new WhatsAppInteractiveListAction(
                'button title',
                []
            )
        );
    }

    public function testWhatsAppInteractiveContentProduct()
    {
        $this->expectException(\Exception::class);

        $this->expectExceptionMessage('Body is required for type '. WhatsAppInteractiveContentTypes::BUTTON);

        new WhatsAppInteractiveContent(
            WhatsAppInteractiveContentTypes::BUTTON,
            null,
            null,
            new WhatsAppInteractiveListAction(
                'button title',
                []
            )
        );
    }

    public function testWhatsAppInteractiveButtonAction()
    {
        $this->expectException(\Exception::class);

        $this->expectExceptionMessage('Button is not derived from WhatsAppInteractiveButtonBase.');

        new WhatsAppInteractiveButtonAction([
            \TypeError::class,
        ]);
    }
}
