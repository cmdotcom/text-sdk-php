<?php

namespace CMText\RichContent\Messages\WhatsApp;

class WhatsAppInteractiveReplyButton extends WhatsAppInteractiveButtonBase
{
    public $reply;

    public function __construct(
        string $title,
        string $id
    )
    {
        parent::__construct(WhatsAppInteractiveButtonTypes::REPLY);

        $this->reply = (object)[
            'id' => $id,
            'title' => $title
        ];
    }
}
