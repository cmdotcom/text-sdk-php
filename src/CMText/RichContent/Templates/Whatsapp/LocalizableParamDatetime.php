<?php


namespace CMText\RichContent\Templates\Whatsapp;


class LocalizableParamDatetime extends LocalizableParamBase
{

    /**
     * @var \DateTimeInterface
     */
    private $datetime;

    /**
     * LocalizableParamDatetime constructor.
     * @param string $Default
     * @param \DateTimeInterface $DateTime
     */
    public function __construct(
        string $Default,
        \DateTimeInterface $DateTime
    )
    {
        parent::__construct($Default);

        $this->datetime = $DateTime;

        $this->setAdditional([
            'date_time' => (object)[
                'component' => (object)[
                    'day_of_week' => $this->datetime->format('N'),
                    'day_of_month' => $this->datetime->format('j'),
                    'year' => $this->datetime->format('Y'),
                    'month' => $this->datetime->format('n'),
                    'hour' => $this->datetime->format('H'),
                    'minute' => $this->datetime->format('i'),
                ]
            ]
        ]);
    }

}