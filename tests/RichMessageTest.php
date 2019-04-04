<?php
require __DIR__ .'/../vendor/autoload.php';


use CMText\Message;

class RichMessageTest extends PHPUnit_Framework_TestCase
{

    /**
     * Result of initializing the TextMessage.
     */
    public function testInitializeText()
    {
        $testText = 'test rich text';

        try {
            $richText = new \CMText\RichContent\Messages\TextMessage($testText);

        }catch (\Exception $e){
            $richText = null;
        }

        $this->assertInstanceOf(
            \CMText\RichContent\Messages\TextMessage::class,
            $richText
        );

        $this->assertJson( json_encode($richText) );

        $json = $richText->jsonSerialize();

        $this->assertObjectHasAttribute(
            'text',
            $json
        );
    }


    public function testInitializeCard()
    {
        $text = 'test rich card text';
        $header = 'test rich card header text';

        $name = 'test media name';
        $uri = 'test://uri';
        $mimetype = 'test/mimetype';

        $media = new \CMText\RichContent\Messages\MediaContent(
            $name,
            $uri,
            $mimetype
        );

        $richCard = new \CMText\RichContent\Messages\CardMessage(
            $text,
            $header,
            $media
        );

        $this->assertInstanceOf(
            \CMText\RichContent\Messages\MediaContent::class,
            $media
        );

        $this->assertInstanceOf(
            \CMText\RichContent\Messages\CardMessage::class,
            $richCard
        );

        $this->assertJson( json_encode($richCard) );

        $json = json_decode( json_encode($richCard) );

        $this->assertObjectHasAttribute(
            'text',
            $json
        );
        $this->assertObjectHasAttribute(
            'header',
            $json
        );
        $this->assertObjectHasAttribute(
            'media',
            $json
        );

        $this->assertObjectHasAttribute(
            'mediaName',
            $json->media
        );
        $this->assertObjectHasAttribute(
            'mediaUri',
            $json->media
        );
        $this->assertObjectHasAttribute(
            'mimeType',
            $json->media
        );
    }


    public function testInitializeCarousel()
    {
        $carousel = new \CMText\RichContent\Messages\CarouselMessage(
            \CMText\RichContent\Messages\CarouselCardWidth::MEDIUM,
            [
                new \CMText\RichContent\Messages\CardMessage(
                    'test rich text',
                    'test rich header text',
                    new \CMText\RichContent\Messages\MediaContent(
                        'test name',
                        'test://uri',
                        'test/mimetype'
                    )
                ),
                new \CMText\RichContent\Messages\CardMessage(
                    'test rich text',
                    'test rich header text',
                    new \CMText\RichContent\Messages\MediaContent(
                        'test name',
                        'test://uri',
                        'test/mimetype'
                    )
                ),
            ]
        );


        $this->assertInstanceOf(
            \CMText\RichContent\Messages\CarouselMessage::class,
            $carousel
        );

        $this->assertJson( json_encode($carousel) );

        $json = json_decode( json_encode($carousel) );

        $this->assertObjectHasAttribute(
            'carousel',
            $json
        );

        $this->assertObjectHasAttribute(
            'cardWidth',
            $json->carousel
        );
        $this->assertEquals(
            \CMText\RichContent\Messages\CarouselCardWidth::MEDIUM,
            $json->carousel->cardWidth
        );

        $this->assertObjectHasAttribute(
            'cards',
            $json->carousel
        );
        $this->assertCount(
            2,
            $json->carousel->cards
        );
    }


    public function testInitializeMedia()
    {
        $media = new \CMText\RichContent\Messages\MediaMessage(
            'test name',
            'test://uri',
            'test/mimetype'
        );


        $this->assertInstanceOf(
            \CMText\RichContent\Messages\MediaMessage::class,
            $media
        );

        $this->assertJson( json_encode($media) );

        $json = json_decode( json_encode($media) );

        $this->assertObjectHasAttribute(
            'media',
            $json
        );

        $this->assertObjectHasAttribute(
            'mediaName',
            $json->media
        );
        $this->assertObjectHasAttribute(
            'mediaUri',
            $json->media
        );
        $this->assertObjectHasAttribute(
            'mimeType',
            $json->media
        );
    }


    public function testApplyMessageToRichContent()
    {
        try {
            $richContent = new \CMText\RichContent\RichContent();
            $richContent->AddConversationPart(
                new \CMText\RichContent\Messages\TextMessage('test rich text')
            );


            $this->assertInstanceOf(
                \CMText\RichContent\RichContent::class,
                $richContent
            );

            $this->assertJson( json_encode($richContent) );

            $json = json_decode( json_encode($richContent) );

            $this->assertCount(
                1,
                $json->conversation
            );


            //  add too many Conversation parts
            for($i = 0; $i < \CMText\RichContent\RichContent::CONVERSATION_LENGTH_LIMIT; ++$i){
                $richContent->AddConversationPart(
                    new \CMText\RichContent\Messages\TextMessage('test rich text')
                );
            }

        }catch (\CMText\Exceptions\ConversationLimitException $conversationLengthException){
            $this->assertInstanceOf(
                \CMText\Exceptions\ConversationLimitException::class,
                $conversationLengthException
            );
        }
    }
}
