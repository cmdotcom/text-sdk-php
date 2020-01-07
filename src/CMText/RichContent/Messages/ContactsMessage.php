<?php

namespace CMText\RichContent\Messages;

use CMText\RichContent\Common\Contact;

/**
 * Class ContactsMessage
 * @package CMText\RichContent\Messages
 */
class ContactsMessage implements IRichMessage
{
    /**
     * @var \CMText\RichContent\Common\Contact[]
     */
    private $contacts = [];

    /**
     * ContactsMessage constructor.
     * @param \CMText\RichContent\Common\Contact $Contact
     */
    public function __construct(Contact $Contact)
    {
        $this->addContact($Contact);
    }

    /**
     * @param \CMText\RichContent\Common\Contact $Contact
     */
    public function addContact(Contact $Contact)
    {
        $this->contacts[] = $Contact;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return (object)[
            'contacts' => array_filter($this->contacts),
        ];
    }
}


