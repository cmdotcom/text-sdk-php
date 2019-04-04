<?php
require __DIR__ .'/../vendor/autoload.php';


use CMText\TextClient;

class TextClientTest extends PHPUnit_Framework_TestCase
{

    /**
     * Result of sending a Message when the gateway is unavailable.
     */
    public function testUnavailableGateway()
    {
        $client = new TextClient('your-api-key', 'unavailablehost');

        $result = $client->SendMessage('body-content', 'CM.com', ['00334455667788']);

        $this->assertEquals(
            \CMText\TextClientStatusCodes::UNKNOWN,
            $result->statusCode
        );
    }


    /**
     * The maximum amount of Message objects in a request should be respected
     */
    public function testMessagesLimit()
    {
        $client = new TextClient('your-api-key');

        try{
            $client->send(
                array_fill(
                    0,
                    TextClient::MESSAGES_MAXIMUM + 1,
                    new \CMText\Message()
                )
            );

        }catch (\Exception $exception){
            $this->assertInstanceOf(
                \CMText\Exceptions\MessagesLimitException::class,
                $exception
            );

        }
    }

}
