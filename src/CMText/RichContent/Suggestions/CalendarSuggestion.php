<?php

namespace CMText\RichContent\Suggestions;

/**
 * Class CalendarSuggestion
 * @package CMText\RichContent\Suggestions
 */
class CalendarSuggestion extends SuggestionBase
{

    /**
     * @var string action command
     */
    protected $action = 'CreateCalendarEvent';

    /**
     * @var \CMText\RichContent\Suggestions\CalendarOptions
     */
    private $calendarOptions;


    /**
     * CalendarSuggestion constructor.
     * @param string $Label
     * @param \CMText\RichContent\Suggestions\CalendarOptions $CalendarOptions
     */
    public function __construct(
        string $Label,
        CalendarOptions $CalendarOptions
    )
    {
        $this->label = $Label;

        $this->calendarOptions = $CalendarOptions;
    }


    public function jsonSerialize()
    {
        return (object)[
            'action' => $this->action,
            'label'  => $this->label,
            'calendar' => $this->calendarOptions,
        ];
    }
}