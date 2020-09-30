<?php


namespace CMText\RichContent\Templates\Whatsapp;


use CMText\RichContent\Templates\TemplateContentBase;

class WhatsappTemplate extends TemplateContentBase
{

    /**
     * The template-key for whatsapp templates
     */
    const TEMPLATE_KEY = 'whatsapp';


    /**
     * WhatsappTemplate constructor.
     * @param string $Namespace
     * @param string $ElementName
     * @param Language $Language
     * @param array $Components
     */
    public function __construct(
        string $Namespace,
        string $ElementName,
        Language $Language,
        array $Components = []
    )
    {
        $this->content = new \stdClass();
        $this->content->namespace = $Namespace;
        $this->content->element_name = $ElementName;
        $this->content->language = $Language;

        if( count($Components) > 0 ){
            $this->addComponents($Components);
        }
    }

    /**
     * Add Components to the Template.
     * @param array $Components
     */
    public function addComponents(array $Components)
    {
        foreach ($Components as $component){
            $this->content->components[] = $component;
        }
    }

}