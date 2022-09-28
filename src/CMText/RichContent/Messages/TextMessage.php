<?php

namespace CMText\RichContent\Messages;

/**
 * Class TextMessage
 * @package CMText\RichContent\Messages
 */
class TextMessage implements IRichMessage
{

    /**
     * @var string Body text of the message
     */
    protected $text;


    /**
     * @var string Instagram message tag (optional)
     */
    protected $tag;


    /**
     * TextMessage constructor.
     * @param string $Text
     * @param string $Tag
     */
    public function __construct(string $Text, string $Tag = '')
    {
        $this->text = $Text;
        $this->tag = $Tag;
    }


	#[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
        return (object)array_filter([
            'text' => $this->text,
            'tag' => $this->tag
        ]);
    }
}