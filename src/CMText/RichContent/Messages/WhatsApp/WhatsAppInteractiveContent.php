<?php

namespace CMText\RichContent\Messages\WhatsApp;


class WhatsAppInteractiveContent implements \JsonSerializable
{
    public $type;

    public $header;

    public $body;

    public $footer;

    public $action;

    /**
     * @param string $type
     * @param WhatsAppInteractiveHeader|null $header
     * @param WhatsAppInteractiveBody|null $body
     * @param IWhatsAppInteractiveAction|null $action
     * @param WhatsAppInteractiveFooter|null $footer
     * @throws \Exception
     */
    public function __construct(
        string $type,
        WhatsAppInteractiveHeader $header = null,
        WhatsAppInteractiveBody $body = null,
        IWhatsAppInteractiveAction $action = null,
        WhatsAppInteractiveFooter $footer = null
    )
    {
        if( !in_array(
            $type,
            (new \ReflectionClass(WhatsAppInteractiveContentTypes::class))->getConstants())
        ){
            throw new \Exception("Unsupport WhatsApp-InteractiveContent-type $type");
        }

        //  action is always required.
        if($action == null){
            throw new \Exception("Action is always Required.");
        }

        //  header is required for type Product-list
        if($type == WhatsAppInteractiveContentTypes::PRODUCT_LIST && $header == null){
            throw new \Exception("Header is required for type $type");
        }

        //  body is optional for type Product, otherwise required.
        if($type != WhatsAppInteractiveContentTypes::PRODUCT && $body == null){
            throw new \Exception("Body is Required for $type");
        }

        $this->type = $type;
        $this->header = $header;
        $this->body = $body;
        $this->footer = $footer;
        $this->action = $action;
    }

    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
        return (object)array_filter([
            'type' => $this->type,
            'header' => $this->header,
            'body' => $this->body,
            'footer' => $this->footer,
            'action' => $this->action
        ]);
    }
}
