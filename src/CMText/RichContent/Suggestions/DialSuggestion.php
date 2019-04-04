<?php

namespace CMText\RichContent\Suggestions;

/**
 * Class DialSuggestion
 * @package CMText\RichContent\Suggestions
 */
class DialSuggestion extends SuggestionBase
{

    /**
     * @var string Action command
     */
    protected $action = 'Dial';

    /**
     * @var \CMText\RichContent\Suggestions\DialOptions
     */
    protected $dial;


    /**
     * DialSuggestion constructor.
     * @param string $Label
     * @param string $Phonenumber
     */
    public function __construct(
        string $Label,
        string $Phonenumber
    )
    {
        $this->label = $Label;
        $this->dial  = new DialOptions($Phonenumber);
    }


    public function jsonSerialize()
    {
        return (object)[
            'action' => $this->action,
            'label'  => $this->label,
            'dial'   => $this->dial,
        ];
    }

}