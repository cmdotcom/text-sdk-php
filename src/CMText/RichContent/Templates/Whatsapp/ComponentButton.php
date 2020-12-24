<?php

namespace CMText\RichContent\Templates\Whatsapp;


use CMText\Exceptions\WhatsappTemplateComponentParameterTypeException;


class ComponentButton extends ComponentBase
{
    /**
     * @inheritdoc
     */
    const TYPE = 'button';

    /**
     * The zero-based index of the Button to set the order in case of several Buttons
     * @var int $index
     */
    public $index;

    /**
     * @inheritdoc
     */
    protected $supportedParameterTypes = [
        ComponentParameterText::TYPE,
        ComponentParameterPayload::TYPE,
    ];

    /**
     * ComponentButton constructor.
     * @param int $index
     * @param ComponentParameterBase $parameter
     * @throws WhatsappTemplateComponentParameterTypeException
     */
    public function __construct(int $index, ComponentParameterBase $parameter)
    {
        parent::__construct(
            self::TYPE,
            [$parameter]
        );

        $this->index = $index;
    }
}