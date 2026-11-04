<?php

namespace CMText\RichContent\Messages\WhatsApp;

/**
 * Contextual properties of the message.
 * Currently only applicable to <see cref="Channel.WhatsApp" />
 * Docs: https://docs.cm.com/messaging/whatsapp/whatsapp-inbound#replying-to-a-users-message
 */
trait WhatsAppMessageContextTrait
{
    /**
     * @var $context WhatsAppMessageContext
     */
    public $context;
}