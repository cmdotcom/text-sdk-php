<?php

namespace CMText\RichContent\Messages\WhatsApp;

abstract class WhatsAppInteractiveButtonBase
{
    public $type;

    public function __construct(string $type)
    {
        $this->type = $type;
    }
}
