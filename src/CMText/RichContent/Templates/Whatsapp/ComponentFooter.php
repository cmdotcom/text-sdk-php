<?php

namespace CMText\RichContent\Templates\Whatsapp;


use CMText\Exceptions\WhatsappTemplateComponentParameterTypeException;


class ComponentFooter extends ComponentBase
{
    /**
     * @inheritdoc
     */
    const TYPE = 'footer';

    /**
     * @inheritdoc
     */
    protected $supportedParameterTypes = [
        ComponentParameterCurrency::TYPE,
        ComponentParameterDatetime::TYPE,
        ComponentParameterText::TYPE,
    ];

    /**
     * ComponentFooter constructor.
     * @param array $parameters
     * @throws WhatsappTemplateComponentParameterTypeException
     */
    public function __construct(array $parameters = [])
    {
        parent::__construct(self::TYPE, $parameters);
    }
}