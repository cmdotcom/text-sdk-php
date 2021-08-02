<?php
require __DIR__ .'/../vendor/autoload.php';


use CMText\MessageBody;
use PHPUnit\Framework\TestCase;

class MessageBodyTest extends TestCase
{

    public function testJsonSerialization()
    {
        $messageBody = new MessageBody('content');

        // Should be Json Serializable with or without multi-byte-string extension
        $json = json_encode($messageBody);
        $this->assertJson(
            $json
        );
    }

    /**
     * Result of setting up a new MessageBody
     */
    public function testSettingContent()
    {
        $content = 'test message body content';

        $messageBody = new MessageBody($content);

        $json = json_encode($messageBody);

        // Content should be set correctly
        $this->assertEquals(
            $content,
            (json_decode($json))->content
        );
    }


    /**
     * Result of setting up a new MessageBodyType
     */
    public function testSettingTypeText()
    {
        $messageBody = new MessageBody(__METHOD__, \CMText\MessageBodyTypes::TEXT);

        $json = json_encode($messageBody);

        // Type should be set correctly
        $this->assertEquals(
            \CMText\MessageBodyTypes::TEXT,
            (json_decode($json))->type
        );
    }


    /**
     * Result of setting up a new MessageBodyType Incorrectly
     */
    public function testSettingTypeIncorrectly()
    {
        $messageBody = new MessageBody('content', 'invalid-type');

        $json = json_encode($messageBody);

        // Type should be set to AUTO
        $this->assertEquals(
            \CMText\MessageBodyTypes::AUTO,
            (json_decode($json))->type
        );


        $messageBody->type = 'still-invalid';

        $json = json_encode($messageBody);

        // Type should be set to AUTO
        $this->assertEquals(
            \CMText\MessageBodyTypes::AUTO,
            (json_decode($json))->type
        );
    }


    public function testWithTypeChaining()
    {
        $messageBody = (new MessageBody('content'))->WithType(\CMText\MessageBodyTypes::BINARY);

        $this->assertInstanceOf(
            MessageBody::class,
            $messageBody
        );

        $this->assertEquals(
            \CMText\MessageBodyTypes::BINARY,
            $messageBody->jsonSerialize()->type
        );
    }
}