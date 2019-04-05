<?php

namespace CMText\RichContent\Messages;

/**
 * Class MediaContent
 * @package CMText\RichContent\Messages
 */
class MediaContent implements \JsonSerializable
{

    /**
     * @var string Display name of media
     */
    private $name;

    /**
     * @var string Uri for the media
     */
    private $uri;

    /**
     * @var string Mime-Type doe the media
     */
    private $mimetype;


    /**
     * MediaContent constructor.
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
        $this->name = $Name;
        $this->uri  = $Uri;
        $this->mimetype = $Mimetype;
    }


    public function jsonSerialize()
    {
        return (object)[
            'mediaName' => $this->name,
            'mediaUri'  => $this->uri,
            'mimeType'  => $this->mimetype
        ];
    }
}