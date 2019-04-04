<?php

namespace CMText\RichContent\Messages;

/**
 * Class MediaMessage
 * @package CMText\RichContent\Messages
 */
class MediaMessage implements IRichMessage
{

    /**
     * @var \CMText\RichContent\Messages\MediaContent
     */
    private $content;


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
        $this->content = new MediaContent($Name, $Uri, $Mimetype);
    }


    public function jsonSerialize()
    {
        return (object)[
            'media' => $this->content,
        ];
    }
}