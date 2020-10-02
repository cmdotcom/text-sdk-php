<?php

namespace CMText\RichContent\Templates\Whatsapp;


class ComponentButtonUrl extends ComponentButton
{
    /**
     * The sub-type of the ButtonComponent
     * @var string $sub_type
     */
    public $sub_type = 'url';

    /**
     * @inheritdoc
     */
    protected $supportedParameterTypes = [
        ComponentParameterText::TYPE,
    ];

    /**
     * ComponentButtonUrl constructor.
     * @param int $index
     * @param ComponentParameterText $parameter
     * @throws \CMText\Exceptions\WhatsappTemplateComponentParameterTypeException
     */
    public function __construct(int $index, ComponentParameterText $parameter)
    {
        parent::__construct($index, $parameter);
    }
}