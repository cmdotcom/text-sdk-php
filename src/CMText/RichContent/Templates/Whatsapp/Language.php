<?php


namespace CMText\RichContent\Templates\Whatsapp;


class Language implements \JsonSerializable
{
    /**
     * @var string Language or Locale code , ie. en or en_US.
     */
    private $code = 'en';

    /**
     * @var string Language policy the message should follow.
     */
    private $policy = 'deterministic';


    /**
     * Language constructor.
     * @param string $Code
     */
    public function __construct(string $Code)
    {
        $this->code = $Code;
    }


    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return (object)[
            'code' => $this->code,
            'policy' => $this->policy,
        ];
    }
}