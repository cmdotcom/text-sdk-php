<?php

namespace CMText\RichContent\Suggestions;

/**
 * Class CalendarOptions
 * @package CMText\RichContent\Suggestions
 */
class CalendarOptions implements \JsonSerializable
{

    /**
     * @var \DateTimeInterface Beginning of event
     */
    private $start;

    /**
     * @var \DateTimeInterface End of event
     */
    private $end;

    /**
     * @var string Title of the event
     */
    private $title;

    /**
     * @var string Description of the event
     */
    private $description;


    /**
     * CalendarOptions constructor.
     * @param \DateTimeInterface $Start
     * @param \DateTimeInterface $End
     * @param string $Title
     * @param string $Description
     */
    public function __construct(
        \DateTimeInterface $Start,
        \DateTimeInterface $End,
        string $Title,
        string $Description
    )
    {
        $this->start = $Start->format(DATE_ATOM);
        $this->end   = $End->format(DATE_ATOM);

        $this->title = $Title;
        $this->description = $Description;
    }


    public function jsonSerialize()
    {
        return (object)[
            'startTime' => $this->start,
            'endTime' => $this->end,
            'title' => $this->title,
            'description' => $this->description,
        ];
    }
}