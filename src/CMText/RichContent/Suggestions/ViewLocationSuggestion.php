<?php

namespace CMText\RichContent\Suggestions;

/**
 * Class ViewLocationSuggestion
 * @package CMText\RichContent\Suggestions
 */
class ViewLocationSuggestion extends SuggestionBase
{

    /**
     * @var string Action command
     */
    protected $action = 'viewLocation';

    /**
     * @var \CMText\RichContent\Suggestions\ViewLocationOptions
     */
    private $viewLocation;


    /**
     * ViewLocationSuggestion constructor.
     * @param string $Label
     * @param \CMText\RichContent\Suggestions\ViewLocationOptions $ViewLocationOptions
     */
    public function __construct(
        string $Label,
        ViewLocationOptions $ViewLocationOptions
    )
    {
        $this->label = $Label;
        $this->viewLocation = $ViewLocationOptions;
    }


    public function jsonSerialize()
    {
        return (object)[
            'action' => $this->action,
            'label' => $this->label,
            'viewLocation' => $this->viewLocation,
        ];
    }

}