<?php

namespace CMText\RichContent\Messages\WhatsApp;

/**
 * Contextual properties of the message.
 * Currently only applicable to <see cref="Channel.WhatsApp" />
 * Docs: https://developers.cm.com/messaging/docs/whatsapp-inbound#mt-replies-mo
 */
trait WhatsAppMessageContextTrait
{
    /**
     * @var $context WhatsAppMessageContext
     */
    public $context;
}