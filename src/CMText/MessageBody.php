<?php

namespace CMText;


use JsonSerializable;

/**
 * Class MessageBody
 *
 * @package CMText
 */
class MessageBody implements JsonSerializable
{

    /**
     * @var string
     */
    private $content;

    /**
     * @var string
     */
    private $type = MessageBodyTypes::AUTO;


    /**
     * MessageBody constructor.
     * @param string $content
     */
    public function __construct(string $content)
    {
        $this->content = $content;
    }


    /**
     * Getters for a limited set or properties, providing normalized results
     *
     * @param $name
     * @return bool|string
     */
    public function __get($name)
    {
        switch ($name){
            /**
             * message content always as utf8 encoded string
             */
            case 'content':
                return $this->content;
                break;

            /**
             * message type as is with a fallback to the defined AUTO MessageBodyType
             */
            case 'type':
                return $this->type ?: MessageBodyTypes::AUTO;
                break;

            default:
                return false;
        }
    }


    /**
     * @return object
     */
    public function jsonSerialize()
    {
        // try to make sure the content as Json-compatible as possible
        if( function_exists('mb_convert_encoding') && function_exists('mb_detect_encoding') ){
            $this->content = mb_convert_encoding(
                $this->content,
                'UTF-8',
                mb_detect_encoding($this->content)
            );
        }

        return (object)[
            'content' => $this->content,
            'type' => $this->type,
        ];
    }
}