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
     * @param \CMText\RichContent\Templates\Whatsapp\Language $Language
     * @param array $LocalizableParams
     */
    public function __construct(
        string $Namespace,
        string $ElementName,
        Language $Language,
        array $LocalizableParams = []
    )
    {
        $this->content = (object)[
            'namespace' => $Namespace,
            'element_name' => $ElementName,
            'language' => $Language,
            'localizable_params' => [],
        ];

        foreach ($LocalizableParams as $localizableParam){
            $this->addLocalizableParam($localizableParam);
        }
    }


    /**
     * @param \CMText\RichContent\Templates\Whatsapp\LocalizableParamBase $LocalizableParam
     */
    public function addLocalizableParam(LocalizableParamBase $LocalizableParam)
    {
        $this->content->localizable_params[] = $LocalizableParam;
    }

}