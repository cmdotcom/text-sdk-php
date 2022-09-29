<?php

namespace CMText\RichContent\Messages\WhatsApp;


class WhatsAppInteractiveSectionRow
{
    public $title;

    public $id;

    public $description;

    /**
     * @param string $title
     * @param string $id
     * @param string|null $description
     */
    public function __construct(
        string $title,
        string $id,
        string $description = null
    )
    {
        $this->title = $title;
        $this->id = $id;
        $this->description = $description;
    }
}