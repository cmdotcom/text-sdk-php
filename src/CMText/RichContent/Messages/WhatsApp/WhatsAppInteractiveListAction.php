<?php

namespace CMText\RichContent\Messages\WhatsApp;

class WhatsAppInteractiveListAction implements IWhatsAppInteractiveAction
{
    public $button;

    public $sections;

    /**
     * @param string $button
     * @param array $sections
     * @throws \Exception
     */
    public function __construct(
        string $button,
        array $sections
    )
    {
        $this->button = $button;

        foreach ($sections??[] as $section){
            if(get_class($section) != WhatsAppInteractiveSection::class){
                throw new \Exception("Section is not a WhatsAppInteractiveSection.");
            }
        }
        $this->sections = $sections;
    }
}
