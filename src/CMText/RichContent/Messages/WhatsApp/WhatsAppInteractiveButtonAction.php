<?php

namespace CMText\RichContent\Messages\WhatsApp;

class WhatsAppInteractiveButtonAction implements IWhatsAppInteractiveAction
{
    public $buttons;

    /**
     * @param array $buttons
     * @throws \Exception
     */
    public function __construct(
        array $buttons
    )
    {
        foreach ($buttons as $b){
            if(!is_subclass_of($b, WhatsAppInteractiveButtonBase::class)){
                throw new \Exception("Button is not derived from WhatsAppInteractiveButtonBase.");
            }
        }
        $this->buttons = $buttons;
    }
}
