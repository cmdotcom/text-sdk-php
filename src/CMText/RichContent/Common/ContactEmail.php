<?php

namespace CMText\RichContent\Common;

use CMText\Exceptions\ContactEmailException;

/**
 * Class ContactEmail
 * @package CMText\RichContent\Common
 */
class ContactEmail implements \JsonSerializable
{
    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $type;

    /**
     * ContactEmail constructor.
     * @param string $Email
     * @param string $Type
     * @throws \CMText\Exceptions\ContactEmailException
     */
    public function __construct(string $Email = '', string $Type = '')
    {
        if(!filter_var($Email, FILTER_VALIDATE_EMAIL)){
            throw new ContactEmailException('Invalid Email');
        }

        if (!in_array(
            $Type,
            [
                ContactEmailTypes::HOME,
                ContactEmailTypes::WORK,
                '',  // no value provided is accepted as well.
            ]
        )) {
            throw new ContactEmailException('Unknown ContactEmail Type');
        }

        $this->email = $Email;
        $this->type = $Type;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        // none of these properties are required, so we filter the empty ones.
        return (object)array_filter([
            'email' => $this->email,
            'type' => $this->type,
        ]);
    }
}