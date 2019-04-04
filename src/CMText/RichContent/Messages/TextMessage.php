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
     * TextMessage constructor.
     * @param string $Text
     */
    public function __construct(string $Text)
    {
        $this->text = $Text;
    }


    public function jsonSerialize()
    {
        return (object)[
            'text' => $this->text
        ];
    }
}