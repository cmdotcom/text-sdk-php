<?php

namespace CMText\RichContent\Suggestions;

/**
 * Class ReplySuggestion
 * @package CMText\RichContent\Suggestions
 */
class ReplySuggestion extends SuggestionBase
{

    /**
     * @var string Action command
     */
    protected $action = 'Reply';

    /**
     * @var string When set, this will be used as reply-text instead of Label
     */
    protected $text;


    public function __construct(
        string $Label,
        string $Text = null
    )
    {
        $this->label = $Label;
        $this->text  = $Text;
    }


    public function jsonSerialize()
    {
        return (object)array_filter([
            'action' => $this->action,
            'label' => $this->label,
            'postbackdata' => $this->text,
        ]);
    }

}