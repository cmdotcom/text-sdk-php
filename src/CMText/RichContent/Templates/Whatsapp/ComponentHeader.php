<?php

namespace CMText\RichContent\Templates\Whatsapp;


use CMText\Exceptions\WhatsappTemplateComponentParameterTypeException;


class ComponentHeader extends ComponentBase
{
    /**
     * @inheritdoc
     */
    const TYPE = 'header';

    /**
     * @inheritdoc
     */
    protected $supportedParameterTypes = [
        ComponentParameterText::TYPE,
        ComponentParameterImage::TYPE,
        ComponentParameterDocument::TYPE,
        ComponentParameterVideo::TYPE,
    ];

    /**
     * ComponentHeader constructor.
     * @param array $parameters
     * @throws WhatsappTemplateComponentParameterTypeException
     */
    public function __construct(array $parameters = [])
    {
        parent::__construct(self::TYPE, $parameters);
    }
}