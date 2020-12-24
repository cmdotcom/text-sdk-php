<?php

namespace CMText\RichContent\Templates\Whatsapp;


abstract class ComponentParameterBase implements \JsonSerializable
{
    /**
     * The Type of the ComponentParameter
     * @const
     */
    const TYPE = self::class;

    /**
     * To expose the ComponentParameter type
     * @var string
     */
    public $type;

    /**
     * ComponentParameterBase constructor.
     * @param string $type
     */
    public function __construct(string $type)
    {
        $this->type = $type;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return $this;
    }

}