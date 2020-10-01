<?php

namespace CMText\RichContent\Templates\Whatsapp;


use CMText\Exceptions\WhatsappTemplateComponentParameterTypeException;


class ComponentBody extends ComponentBase
{
    /**
     * @inheritdoc
     */
    const TYPE = 'body';

    /**
     * @inheritdoc
     */
    protected $supportedParameterTypes = [
        ComponentParameterCurrency::TYPE,
        ComponentParameterDatetime::TYPE,
        ComponentParameterText::TYPE,
    ];

    /**
     * ComponentBody constructor.
     * @param array $parameters
     * @throws WhatsappTemplateComponentParameterTypeException
     */
    public function __construct(array $parameters = [])
    {
        parent::__construct(self::TYPE, $parameters);
    }
}