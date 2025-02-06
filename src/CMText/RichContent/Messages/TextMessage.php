<?php

namespace CMText\RichContent\Messages;

use CMText\RichContent\Messages\WhatsApp\WhatsAppMessageContextTrait;

/**
 * Class TextMessage
 * @package CMText\RichContent\Messages
 */
class TextMessage implements IRichMessage
{
    use WhatsAppMessageContextTrait;

    /**
     * @var string Body text of the message
     */
    public $text;


    /**
     * @var string Instagram message tag (optional)
     */
    public $tag;


    /**
     * TextMessage constructor.
     * @param string $Text
     * @param string $Tag
     */
    public function __construct(string $Text, string $Tag = null)
    {
        $this->text = $Text;
        $this->tag = $Tag;
    }


	#[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
        return $this;
    }
}