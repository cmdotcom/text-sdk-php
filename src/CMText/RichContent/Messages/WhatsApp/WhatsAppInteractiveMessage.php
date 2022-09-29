<?php

namespace CMText\RichContent\Messages\WhatsApp;

use CMText\RichContent\Messages\IRichMessage;

class WhatsAppInteractiveMessage implements IRichMessage
{
    /**
     * @var WhatsAppInteractiveContent
     */
    public $interactive;

    /**
     * @param WhatsAppInteractiveContent $content
     */
    public function __construct(
        WhatsAppInteractiveContent $content
    )
    {
        $this->interactive = $content;
    }

    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
        return $this;
    }
}