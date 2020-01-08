<?php


namespace CMText\RichContent\Templates;


abstract class TemplateContentBase implements ITemplateContent
{

    /**
     * Template key
     */
    const TEMPLATE_KEY = '';

    /**
     * the Content Object with the actual template properties.
     * @var $content object
     */
    protected $content;

    /**
     * @inheritDoc
     */
    function jsonSerialize()
    {
        return (object)[
            static::TEMPLATE_KEY => $this->content
        ];
    }

}