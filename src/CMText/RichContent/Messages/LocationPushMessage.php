<?php

namespace CMText\RichContent\Messages;

use CMText\RichContent\Common\ViewLocationBase;

/**
 * Class LocationPushMessage
 * @package CMText\RichContent\Messages
 */
class LocationPushMessage implements IRichMessage
{
    /**
     * @var \CMText\RichContent\Common\ViewLocationBase Location to send.
     */
    private $location;


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
    public function jsonSerialize()
    {
        return (object)[
            'location' => $this->location,
        ];
    }
}