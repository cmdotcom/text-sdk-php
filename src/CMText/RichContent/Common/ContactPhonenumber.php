<?php

namespace CMText\RichContent\Common;

use CMText\Exceptions\ContactPhonenumberException;

/**
 * Class ContactPhonenumber
 * @package CMText\RichContent\Common
 */
class ContactPhonenumber implements \JsonSerializable
{
    /**
     * @var string
     */
    private $phone;

    /**
     * @var string A value from ContactPhonenumberTypes
     */
    private $type;

    /**
     * ContactPhonenumber constructor.
     * @param string $Phone
     * @param string $PhonenumberType
     * @throws \CMText\Exceptions\ContactPhonenumberException
     */
    public function __construct(string $Phone = '', string $PhonenumberType = '')
    {
        if(!in_array(
            $PhonenumberType,
            [
                ContactPhonenumberTypes::CELL,
                ContactPhonenumberTypes::MAIN,
                ContactPhonenumberTypes::HOME,
                ContactPhonenumberTypes::IPHONE,
                ContactPhonenumberTypes::WORK,
                '', // no value provided is allowed.
            ]
        )){
            throw new ContactPhonenumberException('Unknown Phonenumber Type');
        }

        $this->phone = $Phone;
        $this->type = $PhonenumberType;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        // none of the properties are required, so we filter the empty ones.
        return (object)array_filter([
            'phone' => $this->phone,
            'type' => $this->type,
        ]);
    }
}