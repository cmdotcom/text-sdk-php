<?php

namespace CMText\RichContent\Templates\Whatsapp;


class ComponentParameterPayload extends ComponentParameterBase
{
    /**
     * @inheritdoc
     */
    const TYPE = 'payload';

    /**
     * The payload to expose
     * @var string $payload
     */
    public $payload;

    /**
     * ComponentParameterPayload constructor.
     * @param string $payload
     */
    public function __construct(string $payload)
    {
        parent::__construct(self::TYPE);

        $this->payload = $payload;
    }
}