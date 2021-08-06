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
    private $type;


    /**
     * MessageBody constructor.
     * @param string $content
     * @param string $type
     */
    public function __construct(string $content, string $type = MessageBodyTypes::AUTO)
    {
        $this->__set('content', $content);
        $this->__set('type', $type);
    }


    /**
     * Setters providing sanitized results
     *
     * @param $name
     * @param $value
     * @return void
     */
    public function __set($name, $value)
    {
        switch ($name){
            case 'type':
                if( in_array(
                    $value,
                    (new \ReflectionClass(MessageBodyTypes::class))->getConstants()
                ) ){
                    $this->type = $value;
                }else{
                    $this->type = MessageBodyTypes::AUTO;
                }
                break;

            case 'content':
                // try to make sure the content as Json-compatible as possible
                if( function_exists('mb_convert_encoding') && function_exists('mb_detect_encoding') ){
                    $value = mb_convert_encoding(
                        $value,
                        'UTF-8',
                        mb_detect_encoding($value)
                    );
                }

                $this->content = $value;
                break;
        }
    }


    /**
     * @param string $type
     * @return $this
     */
    public function WithType(string $type): MessageBody
    {
        $this->__set('type', $type);
        return $this;
    }


    /**
     * @return object
     */
    public function jsonSerialize()
    {
        return (object)[
            'content' => $this->content,
            'type' => $this->type,
        ];
    }
}