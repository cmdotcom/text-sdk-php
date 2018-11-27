<?php

namespace CMText;


use JsonSerializable;

/**
 * Class TextClientRequest
 *
 * @package CMText
 */
class TextClientRequest implements JsonSerializable
{

    /**
     * Keeps the "api key"
     *
     * @var string
     */
    private $producttoken;

    /**
     * Keeps the array of Message objects that will be sent
     *
     * @var array
     */
    private $messages;


    /**
     * TextClientRequest constructor.
     *
     * @param string $apiKey
     * @param array  $messages
     */
    public function __construct(string $apiKey, array $messages)
    {
        $this->producttoken = $apiKey;

        $this->messages = $messages;
    }

    /**
     * @return object
     */
    public function jsonSerialize()
    {
        return (object)[
            'messages' => (object)[

                'authentication' => (object)[
                    'producttoken' => $this->producttoken,
                ],

                'msg' => $this->messages
            ]
        ];
    }
}