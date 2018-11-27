<?php
require __DIR__ .'/../vendor/autoload.php';


class SampleCodeTest extends PHPUnit_Framework_TestCase
{

    /**
     * Result of using SendMessage() should be a TextClientResult object.
     */
    public function testResultModel()
    {
        $client = new \CMText\TextClient('your-api-key', \CMText\Gateways::GLOBAL);

        $response = $client->SendMessage('test message', 'CM.com', ['00334455667788'], 'Your_Reference');

        $this->assertInstanceOf(
            \CMText\TextClientResult::class,
            $response
        );
    }

    /**
     * Result of using a bad api-key should be that specific error.
     */
    public function testApiKeyIncorrect()
    {
        $client = new \CMText\TextClient('your-api-key', \CMText\Gateways::GLOBAL);

        $response = $client->send([]);

        $this->assertEquals(
            \CMText\TextClientStatusCodes::APIKEY_INCORRECT,
            $response->statusCode
        );
    }

}