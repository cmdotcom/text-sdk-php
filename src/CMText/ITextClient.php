<?php

namespace CMText;


interface ITextClient
{
    /**
     * ITextClient constructor.
     *
     * @param string $apiKey
     * @param string $gateway
     */
    public function __construct(
        string $apiKey,
        $gateway = Gateways::GLOBAL
    );

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
    );

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
    );
}