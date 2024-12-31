<?php
require __DIR__ .'/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;

class RichMessageTest extends TestCase
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

        $this->assertTrue(
            property_exists($json, 'text')
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

        $this->assertTrue(
            property_exists($json, 'text')
        );
        $this->assertTrue(
            property_exists($json, 'header')
        );
        $this->assertTrue(
            property_exists($json, 'media')
        );

        $this->assertTrue(
            property_exists($json->media, 'mediaName')
        );
        $this->assertTrue(
            property_exists($json->media, 'mediaUri')
        );
        $this->assertTrue(
            property_exists($json->media, 'mimeType')
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

        $this->assertTrue(
            property_exists($json, 'carousel')
        );

        $this->assertTrue(
            property_exists($json->carousel, 'cardWidth')
        );
        $this->assertEquals(
            \CMText\RichContent\Messages\CarouselCardWidth::MEDIUM,
            $json->carousel->cardWidth
        );

        $this->assertTrue(
            property_exists($json->carousel, 'cards')
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

        $this->assertTrue(
            property_exists($json, 'media')
        );

        $this->assertTrue(
            property_exists($json->media, 'mediaName')
        );
        $this->assertTrue(
            property_exists($json->media, 'mediaUri')
        );
        $this->assertTrue(
            property_exists($json->media, 'mimeType')
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


    public function testInitializeLocationPush()
    {
        $dynamicLocation = new \CMText\RichContent\Common\ViewLocationDynamic(
            'CM HQ',
            'Konijnenberg 30, Breda'
        );

        $this->assertInstanceOf(
            \CMText\RichContent\Common\ViewLocationBase::class,
            $dynamicLocation
        );

        $location = new \CMText\RichContent\Messages\LocationPushMessage( $dynamicLocation );

        $this->assertJson( json_encode($location) );

        $json = json_decode( json_encode($location) );

        $this->assertTrue(
            property_exists($json, 'location')
        );

        $this->assertTrue(
            property_exists($json->location, 'label')
        );
        $this->assertTrue(
            property_exists($json->location, 'searchQuery')
        );
        $this->assertFalse(
            property_exists($json->location, 'radius')
        );




        $staticLocation = new CMText\RichContent\Common\ViewLocationStatic(
            'CM HQ',
            '51.603802',
            '4.770821',
            3
        );

        $this->assertInstanceOf(
            \CMText\RichContent\Common\ViewLocationBase::class,
            $staticLocation
        );

        $location = new CMText\RichContent\Messages\LocationPushMessage( $staticLocation );

        $this->assertJson( json_encode($location) );

        $json = json_decode( json_encode($location) );

        $this->assertTrue(
            property_exists($json, 'location')
        );

        $this->assertTrue(
            property_exists($json->location, 'latitude')
        );
        $this->assertTrue(
            property_exists($json->location, 'longitude')
        );
        $this->assertTrue(
            property_exists($json->location, 'label')
        );
        $this->assertTrue(
            property_exists($json->location, 'radius')
        );
    }


    public function testInitializeContactsMessage()
    {
        // set up all the Contact properties
        $contactProperties['address'] = new \CMText\RichContent\Common\ContactAddress('Breda', 'Netherlands', 'NL');
        $contactProperties['birthday'] = new \CMText\RichContent\Common\ContactBirthday( new DateTime() );
        $contactProperties['email'] = new \CMText\RichContent\Common\ContactEmail('info@cm.com');
        $contactProperties['name'] = new \CMText\RichContent\Common\ContactName('CM.com Be part of it.');
        $contactProperties['organization'] = new \CMText\RichContent\Common\ContactOrganization('CM.com', 'Development');
        $contactProperties['phonenumber'] = new \CMText\RichContent\Common\ContactPhonenumber('+31765727000');
        $contactProperties['url'] = new \CMText\RichContent\Common\ContactUrl('https://cm.com');

        // test full initialization
        $contact = new \CMText\RichContent\Common\Contact(
            $contactProperties['address'],
            $contactProperties['birthday'],
            $contactProperties['email'],
            $contactProperties['name'],
            $contactProperties['organization'],
            $contactProperties['phonenumber'],
            $contactProperties['url']
        );

        $contactsMessage = new \CMText\RichContent\Messages\ContactsMessage($contact);

        $this->assertInstanceOf(
            \CMText\RichContent\Messages\ContactsMessage::class,
            $contactsMessage
        );

        $contactsMessage->addContact($contact);

        $this->assertJson( json_encode($contactsMessage) );

        $json = json_decode(json_encode($contactsMessage));

        $this->assertTrue(
            property_exists($json, 'contacts')
        );
        $this->assertCount(
            2,
            $json->contacts
        );
        $this->assertTrue(
            property_exists($json->contacts[0], 'org')
        );
    }
}
