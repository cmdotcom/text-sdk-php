<?php

namespace CMText;


use JsonSerializable;

/**
 * Class Message
 *
 * @package CMText
 */
class Message implements JsonSerializable
{

    /**
     * @var \CMText\MessageBody
     */
    private $body;

    /**
     * @var string
     */
    private $customgrouping3;

    /**
     * @var string
     */
    private $from;

    /**
     * @var string
     */
    private $reference;

    /**
     * @var array
     */
    private $to = [];

    /**
     *
     */
    const SENDER_FALLBACK = 'cm.com';


    /**
     * Message constructor.
     *
     * @param string      $body
     * @param string|null $from
     * @param array       $to
     * @param string|null $reference
     */
    public function __construct(string $body = '', string $from = null, array $to = [], string $reference = null)
    {
        $this->body = new MessageBody($body);
        $this->from = $from ?? self::SENDER_FALLBACK;
        $this->reference = $reference;
        $this->to = $to;

        $this->customgrouping3 = 'text-sdk-php-' . TextClient::VERSION;
    }


    /**
     * Setters for a limited set of properties
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        switch ($name){
            case 'body':
                $this->body = new MessageBody($value);
                break;

            case 'from':
            case 'reference':
            case 'to':
                $this->{$name} = $value;
                break;
        }
    }

    /**
     * @return object
     */
    public function jsonSerialize()
    {
        return (object)[
            'body'      => $this->body,
            'from'      => $this->from,
            'reference' => $this->reference,
            'to'        => array_map(function ($number){
                return (object)[
                    'number' => $number,
                ];
            }, $this->to),
            'customgrouping3' => $this->customgrouping3
        ];
    }
}