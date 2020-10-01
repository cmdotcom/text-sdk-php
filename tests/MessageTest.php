<?php
require __DIR__ .'/../vendor/autoload.php';

use CMText\Channels;
use CMText\Message;

class MessageTest extends PHPUnit_Framework_TestCase
{

    /**
     * Result of initializing the Message class with parameters.
     */
    public function testInitializingCorrectly()
    {
        $testSender = 'test-sender';

        try {
            $new = new Message(
                'test text',
                $testSender,
                [
                    '00334455667788',
                ]
            );

        }catch (\Exception $e){
            $new = null;
        }

        $this->assertInstanceOf(
            Message::class,
            $new
        );

        $json = $new->jsonSerialize();

        $this->assertEquals(
            $testSender,
            $json->from
        );
    }


    /**
     * Result of setting properties on a Message object.
     */
    public function testSettingProperties()
    {
        $body = 'Ether Ð and Euro € icons, and a ß for German text';
        $from = 'test-sender';
        $to = [
            '11111111111111',
            '22222222222222',
            '99999999999999',
        ];
        $reference = 'test-reference';

        // initialize an empty Message
        $new = new Message();

        // set properties on the fly
        $new->body = $body;
        $new->from = $from;
        $new->to = $to;
        $new->reference = $reference;

        // get an instance that we can check
        $json = $new->jsonSerialize();

        // verify the Body content is correctly set
        $this->assertEquals(
            $body,
            $json->body->content
        );

        // verify the Sender is correctly set
        $this->assertEquals(
            $from,
            $json->from
        );

        // verify the Reference is correctly set
        $this->assertEquals(
            $reference,
            $json->reference
        );

        // verify the correct amount of Recipients are added
        $this->assertCount(
            count($to),
            $json->to
        );

        // verify the Recipients are correctly set
        while(current($to)) {
            $this->assertCount(
                1,
                array_filter($json->to, function ($jsonTo) use ($to) {
                    return $jsonTo == (object)[
                            'number' => current($to)
                        ];
                })
            );

            next($to);
        }

        // verify Recipient limit is respected
        try{
            for ($i = 0; $i < Message::RECIPIENTS_MAXIMUM; ++$i){
                $new->AddRecipients([
                    str_pad('00', 13, strval($i))
                ]);
            }

        }catch (\Exception $exception){
            $this->assertInstanceOf(
                \CMText\Exceptions\RecipientLimitException::class,
                $exception
            );
        }
    }

    /**
     * Tests if supplied channel is returned properly
     */
    public function testAllowedChannel()
    {
        $message = new Message();
        $message->WithChannels([Channels::WHATSAPP]);

        $json = $message->jsonSerialize();
        $this->assertEquals($json->allowedChannels, [Channels::WHATSAPP]);
    }

    /**
     * Tests if supplied channels are returned properly
     */
    public function testAllowedChannels()
    {
        $message = new Message();
        $message->WithChannels([Channels::WHATSAPP, Channels::SMS]);

        $json = $message->jsonSerialize();
        $this->assertEquals($json->allowedChannels, [Channels::SMS, Channels::WHATSAPP]);
    }

    /**
     * Tests if a Template message is formatted properly
     * @throws \CMText\Exceptions\WhatsappTemplateComponentParameterTypeException
     */
    public function testWithTemplate()
    {
        $message = new \CMText\Message();
        $message->WithTemplate(
            new \CMText\RichContent\Messages\TemplateMessage(
                new \CMText\RichContent\Templates\Whatsapp\WhatsappTemplate(
                    'namespace',
                    'elementname',
                    new \CMText\RichContent\Templates\Whatsapp\Language('nl')
                )
            )
        );

        $json = json_decode(json_encode($message));

        $this->assertObjectHasAttribute(
            'richContent',
            $json
        );

        $this->assertObjectHasAttribute(
            'conversation',
            $json->richContent
        );

        $this->assertObjectHasAttribute(
            'template',
            $json->richContent->conversation[0]
        );

        $this->assertObjectHasAttribute(
            'whatsapp',
            $json->richContent->conversation[0]->template
        );
    }


    public function testWithPayment()
    {
        $message = new \CMText\Message();
        $message->WithPayment(
            new \CMText\RichContent\Messages\PaymentMessage(
                new \CMText\RichContent\Payments\ApplePayConfiguration(
                    'merchant name',
                    'dscription text',
                    'order reference',
                    19.99,
                    'EUR',
                    'recipient@email',
                    'NL',
                    'EN',
                    true,
                    true,
                    [
                        new \CMText\RichContent\Common\LineItem(
                            'label',
                            'type',
                            19.99
                        )
                    ]
                )
            )
        );

        $json = json_decode(json_encode($message));

        $this->assertObjectHasAttribute(
            'richContent',
            $json
        );

        $this->assertObjectHasAttribute(
            'conversation',
            $json->richContent
        );

        $this->assertObjectHasAttribute(
            'payment',
            $json->richContent->conversation[0]
        );

        $this->assertObjectHasAttribute(
            'lineItems',
            $json->richContent->conversation[0]->payment
        );
    }
}
