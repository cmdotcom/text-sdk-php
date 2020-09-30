<?php


namespace CMText\RichContent\Templates\Whatsapp;


use DateTimeInterface;
use stdClass;

class ComponentParameterDatetime extends ComponentParameterBase
{
    /**
     * @inheritdoc
     */
    const TYPE = 'date_time';

    /**
     * The date_time object
     * @var stdClass
     */
    public $date_time;

    /**
     * ComponentParameterDatetime constructor.
     * @param string $fallback_value Fallback value in case formatting the DateTime object fails
     * @param DateTimeInterface $datetime
     */
    public function __construct(
        string $fallback_value,
        DateTimeInterface $datetime
    )
    {
        parent::__construct(self::TYPE);

        $this->date_time = new stdClass;
        $this->date_time->fallback_value = $fallback_value;
        $this->date_time->timestamp = $datetime->getTimestamp();
    }

}