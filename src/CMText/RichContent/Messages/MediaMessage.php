<?php

namespace CMText\RichContent\Messages;

use CMText\RichContent\Messages\WhatsApp\WhatsAppMessageContextTrait;

/**
 * Class MediaMessage
 * @package CMText\RichContent\Messages
 */
class MediaMessage implements IRichMessage
{
    use WhatsAppMessageContextTrait;

    /**
     * @var \CMText\RichContent\Messages\MediaContent
     */
    public $media;


    /**
     * MediaMessage constructor.
     * @param string $Name
     * @param string $Uri
     * @param string $Mimetype
     */
    public function __construct(
        string $Name,
        string $Uri,
        string $Mimetype
    )
    {
        $this->media = new MediaContent($Name, $Uri, $Mimetype);
    }


	#[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
        return $this;
    }
}