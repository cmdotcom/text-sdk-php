<?php

namespace CMText;


use CMText\Exceptions\MessagesLimitException;

/**
 * Class TextClient
 *
 * @package CMText
 */
class TextClient implements ITextClient
{

    /**
     * @var string
     */
    private $gateway;

    /**
     * @var
     */
    private $apiKey;

    /**
     * @var array
     */
    private $messages = [];

    /**
     * Maximum amount of Message objects allowed per request
     */
    const MESSAGES_MAXIMUM = 1000;

    /**
     * SDK Version constant
     */
    const VERSION = '1.2.2';


    /**
     * TextClient constructor.
     *
     * @param string $apiKey
     * @param string $gateway optional
     */
    public function __construct(
        string $apiKey,
        $gateway = Gateways::GLOBAL
    )
    {
        // load the CM API KEY for authentication against the gateway
        $this->apiKey = $apiKey;

        // set the Gateway to use
        $this->gateway = $gateway;
    }


    /**
     * Fast and easy method to instantly send one message.
     *
     * @param string $message - Message body to send
     * @param string $from - Sender name
     * @param array $to - Recipient phonenumbers
     * @param string $reference optional
     *
     * @return TextClientResult
     */
    public function SendMessage(
        string $message,
        string $from,
        array $to,
        string $reference = null
    )
    {
        try {
            // store this Message
            $this->messages[] = new Message($message, $from, $to, $reference);

            // send it out instantly
            return self::send();

        }catch (\Exception $exception){
            return new TextClientResult(
                TextClientStatusCodes::UNKNOWN,
                json_encode(['details' => $exception->getMessage()])
            );
        }
    }


    /**
     * Send an array of Message objects.
     *
     * @param array $messages Array of Message objects
     *
     * @return TextClientResult
     * @throws \CMText\Exceptions\MessagesLimitException
     */
    public function send(
        array $messages = []
    )
    {
        // set provided messages
        $this->messages = $messages ?: $this->messages;

        if(count($this->messages) > self::MESSAGES_MAXIMUM){
            throw new MessagesLimitException('Maximum amount of Message objects exceeded. ('. self::MESSAGES_MAXIMUM .')');
        }

        $requestModel = new TextClientRequest($this->apiKey, $this->messages);

        $ch = curl_init($this->gateway);

        try {
            curl_setopt_array($ch, [
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => json_encode($requestModel),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTPHEADER => [
                    'Content-Type: application/json; charset=utf-8',
                    'Content-Length: ' . strlen( json_encode($requestModel) ),
                    'X-CM-SDK: ' . 'text-sdk-php-' . self::VERSION,
                ],
                CURLOPT_TIMEOUT => 20,
                CURLOPT_CONNECTTIMEOUT => 5,
            ]);

            $response = curl_exec($ch);
            $statuscode = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);

            // curl errors will raise an exception
            if( curl_error($ch) ){
                throw new \Exception( curl_error($ch) );
            }

        }catch (\Exception $exception){
            $response = json_encode(['details' => $exception->getMessage()]);
            $statuscode = TextClientStatusCodes::UNKNOWN;

        }finally{
            curl_close($ch);
        }

        $return = new TextClientResult($statuscode, $response);

        return $return;
    }

}