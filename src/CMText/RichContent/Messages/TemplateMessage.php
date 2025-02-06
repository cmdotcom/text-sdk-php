<?php

namespace CMText\RichContent\Messages;

use CMText\RichContent\Messages\WhatsApp\WhatsAppMessageContextTrait;
use CMText\RichContent\Templates\TemplateContentBase;


class TemplateMessage implements IRichMessage
{
    use WhatsAppMessageContextTrait;

    public $template;


    public function __construct(TemplateContentBase $Template)
    {
        $this->template = $Template;
    }

    /**
     * @inheritDoc
     */
	#[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
        return $this;
    }
}