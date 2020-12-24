<?php

namespace CMText\RichContent\Templates\Whatsapp;


class ComponentButtonQuickReply extends ComponentButton
{
    /**
     * The sub-type of the ButtonComponent
     * @var string $sub_type
     */
    public $sub_type = 'quick_reply';

    /**
     * @inheritdoc
     */
    protected $supportedParameterTypes = [
        ComponentParameterPayload::TYPE,
    ];

    /**
     * ComponentButtonQuickReply constructor.
     * @param int $index
     * @param ComponentParameterPayload $parameter
     * @throws \CMText\Exceptions\WhatsappTemplateComponentParameterTypeException
     */
    public function __construct(int $index, ComponentParameterPayload $parameter)
    {
        parent::__construct($index, $parameter);
    }
}