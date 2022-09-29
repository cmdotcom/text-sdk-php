<?php

namespace CMText\RichContent\Messages\WhatsApp;

class WhatsAppInteractiveBody
{
    public $text;

    public function __construct(
        string $text
    )
    {
        $this->text = $text;
    }
}