<?php
require __DIR__ .'/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;

class SampleCodeTest extends TestCase
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

}