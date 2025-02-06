<?php

namespace CMText\RichContent\Messages;

use CMText\RichContent\Common\Contact;
use CMText\RichContent\Messages\WhatsApp\WhatsAppMessageContextTrait;

/**
 * Class ContactsMessage
 * @package CMText\RichContent\Messages
 */
class ContactsMessage implements IRichMessage
{
    use WhatsAppMessageContextTrait;

    /**
     * @var Contact[]
     */
    private $contacts = [];

    /**
     * ContactsMessage constructor.
     * @param Contact $Contact
     */
    public function __construct(Contact $Contact)
    {
        $this->addContact($Contact);
    }

    /**
     * @param Contact $Contact
     */
    public function addContact(Contact $Contact)
    {
        $this->contacts[] = $Contact;
    }

    /**
     * @inheritDoc
     */
	#[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
        return $this;
    }
}


