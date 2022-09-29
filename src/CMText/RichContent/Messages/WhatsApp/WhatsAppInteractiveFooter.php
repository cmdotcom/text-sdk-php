<?php

namespace CMText\RichContent\Messages\WhatsApp;

class WhatsAppInteractiveFooter
{
    public $text;

    /**
     * @param string $text
     */
    public function __construct(
        string $text
    )
    {
        $this->text = $text;
    }
}