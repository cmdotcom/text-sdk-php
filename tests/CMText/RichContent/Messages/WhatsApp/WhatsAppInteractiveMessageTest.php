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

//        echo json_encode($CMTextMessage);

        $this->assertInstanceOf(
            Message::class,
            $CMTextMessage
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
}
