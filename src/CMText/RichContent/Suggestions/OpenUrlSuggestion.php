<?php

namespace CMText\RichContent\Suggestions;

/**
 * Class OpenUrlSuggestion
 * @package CMText\RichContent\Suggestions
 */
class OpenUrlSuggestion extends SuggestionBase
{

    /**
     * @var string Action command
     */
    protected $action = 'OpenUrl';

    /**
     * @var string Url to point to
     */
    private $url;


    /**
     * OpenUrlSuggestion constructor.
     * @param string $Label
     * @param string $Url
     */
    public function __construct(
        string $Label,
        string $Url
    )
    {
        $this->label = $Label;
        $this->url   = $Url;
    }


    public function jsonSerialize()
    {
        return (object)[
            'action' => $this->action,
            'label' => $this->label,
            'url' => $this->url,
        ];
    }
}