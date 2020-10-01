<?php

namespace CMText\RichContent\Templates\Whatsapp;


class ComponentParameterText extends ComponentParameterBase
{
    /**
     * @inheritdoc
     */
    const TYPE = 'text';

    /**
     * The text to expose
     * @var string
     */
    public $text;

    /**
     * ComponentParameterText constructor.
     * @param string $text
     */
    public function __construct(string $text)
    {
        parent::__construct(self::TYPE);

        $this->text = $text;
    }

}