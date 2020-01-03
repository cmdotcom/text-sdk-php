<?php

namespace CMText\RichContent\Suggestions;

use CMText\RichContent\Common\ViewLocationBase;

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
     * @var ViewLocationBase
     */
    private $viewLocation;


    /**
     * ViewLocationSuggestion constructor.
     * @param string $Label
     * @param ViewLocationBase $ViewLocation
     */
    public function __construct(
        string $Label,
        ViewLocationBase $ViewLocation
    )
    {
        $this->label = $Label;
        $this->viewLocation = $ViewLocation;
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