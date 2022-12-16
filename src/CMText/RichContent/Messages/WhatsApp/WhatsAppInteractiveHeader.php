<?php

namespace CMText\RichContent\Messages\WhatsApp;

use CMText\RichContent\Messages\MediaContent;

class WhatsAppInteractiveHeader
{
    public $type;

    public $text;

    public $media;

    /**
     * @param string $type
     * @param string $text
     * @param MediaContent|null $media
     * @throws \Exception
     */
    public function __construct(
        string $type,
        string $text = null,
        MediaContent $media = null)
    {
        if( !in_array($type, (new \ReflectionClass(WhatsAppInteractiveHeaderTypes::class))->getConstants()) ){
            throw new \Exception("Unsupported WhatsApp-InteractiveHeader-type $type");
        }

        $this->type = $type;
        $this->text = !$text ? null : $text;
        $this->media = $media;
    }
}
