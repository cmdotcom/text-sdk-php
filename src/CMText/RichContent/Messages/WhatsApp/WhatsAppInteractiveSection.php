<?php

namespace CMText\RichContent\Messages\WhatsApp;


class WhatsAppInteractiveSection
{
    public $title;

    public $rows;

    /**
     * @param string $title
     * @param array $rows
     * @throws \Exception
     */
    public function __construct(
        string $title,
        array $rows
    )
    {
        $this->title = $title;

        foreach ($rows as $row){
            if(get_class($row) != WhatsAppInteractiveSectionRow::class){
                throw new \Exception("Unsupported Row-type : " . get_class($row));
            }
        }

        $this->rows = $rows;
    }
}