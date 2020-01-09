<?php
require __DIR__ .'/../vendor/autoload.php';


use CMText\MessageBody;

class MessageBodyTest extends PHPUnit_Framework_TestCase
{

    /**
     * Result of setting up a new MessageBody
     */
    public function testReadingProperties()
    {
        $content = 'test message body content';

        $messageBody = new MessageBody($content);

        // Content should be set correctly
        $this->assertEquals(
            $content,
            $messageBody->content
        );

        // Type should be set as expected
        $this->assertEquals(
            \CMText\MessageBodyTypes::AUTO,
            $messageBody->type
        );

        // unknown properties should return false
        $this->assertFalse(
            $messageBody->unknownProperty
        );

        // Should be Json Serializable with or without multi-byte-string extension
        $this->assertJson(
            json_encode($messageBody)
        );
    }

}
