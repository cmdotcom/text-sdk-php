<?php

namespace CMText\RichContent\Messages;

/**
 * Class CardMessage
 * @package CMText\RichContent\Messages
 */
class CardMessage implements IRichMessage
{

    /**
     * @var string Header text
     */
    private $header;

    /**
     * @var string Body text
     */
    private $text;

    /**
     * @var \CMText\RichContent\Messages\MediaContent
     */
    private $mediaContent;


    /**
     * CardMessage constructor.
     * @param string $Text
     * @param string $Header
     * @param \CMText\RichContent\Messages\MediaContent $Media
     */
    public function __construct(string $Text, string $Header, MediaContent $Media)
    {
        $this->header = $Header;
        $this->text   = $Text;
        $this->mediaContent = $Media;
    }


    public function jsonSerialize()
    {
        return (object)[
            'header' => $this->header,
            'text'   => $this->text,
            'media'  => $this->mediaContent,
        ];
    }

}