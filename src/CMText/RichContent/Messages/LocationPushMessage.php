<?php

namespace CMText\RichContent\Messages;

use CMText\RichContent\Common\ViewLocationBase;
use CMText\RichContent\Messages\WhatsApp\WhatsAppMessageContextTrait;

/**
 * Class LocationPushMessage
 * @package CMText\RichContent\Messages
 */
class LocationPushMessage implements IRichMessage
{
    use WhatsAppMessageContextTrait;

    /**
     * @var \CMText\RichContent\Common\ViewLocationBase Location to send.
     */
    public $location;


    /**
     * LocationPushMessage constructor.
     * @param \CMText\RichContent\Common\ViewLocationBase $ViewLocation
     */
    public function __construct(ViewLocationBase $ViewLocation)
    {
        $this->location = $ViewLocation;
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