<?php

namespace CMText\RichContent\Messages;

use CMText\RichContent\Templates\TemplateContentBase;


class TemplateMessage implements IRichMessage
{

    private $template;


    public function __construct(TemplateContentBase $Template)
    {
        $this->template = $Template;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return (object)[
            'template' => $this->template,
        ];
    }
}