<?php

namespace CMText\RichContent\Suggestions;

/**
 * Class DialOptions
 * @package CMText\RichContent\Suggestions
 */
class DialOptions implements \JsonSerializable
{

    /**
     * @var string Phonenumber in International format (ie. +334455667788)
     */
    private $phonenumber;


    /**
     * DialOptions constructor.
     * @param string $phonenumber
     */
    public function __construct(string $phonenumber)
    {
        $this->phonenumber = $phonenumber;
    }


    public function jsonSerialize()
    {
        return (object)[
            'PhoneNumber' => $this->phonenumber,
        ];
    }
}