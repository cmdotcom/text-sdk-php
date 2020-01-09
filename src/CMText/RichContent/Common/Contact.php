<?php

namespace CMText\RichContent\Common;

use CMText\Exceptions\ContactException;

/**
 * Class Contact
 * @package CMText\RichContent\Common
 */
class Contact implements \JsonSerializable
{
    /**
     * @var \CMText\RichContent\Common\ContactAddress[]
     */
    private $addresses = [];

    /**
     * @var \CMText\RichContent\Common\ContactBirthday
     */
    private $birthday;

    /**
     * @var \CMText\RichContent\Common\ContactEmail[]
     */
    private $emails = [];

    /**
     * @var \CMText\RichContent\Common\ContactName
     */
    private $name;

    /**
     * @var \CMText\RichContent\Common\ContactOrganization
     */
    private $organization;

    /**
     * @var \CMText\RichContent\Common\ContactPhonenumber[]
     */
    private $phones = [];

    /**
     * @var \CMText\RichContent\Common\ContactUrl[]
     */
    private $urls = [];

    /**
     * Contact constructor.
     * @param mixed ...$arguments
     * @throws \CMText\Exceptions\ContactException
     */
    public function __construct(...$arguments)
    {
        foreach ($arguments as $argument) {
            $switchKey = get_class( is_array($argument) ? (object)$argument[0] : (object)$argument);

            switch ($switchKey) {
                case ContactAddress::class: // accepts an array of ContactAddress objects.
                    if (is_object($argument)) {
                        $argument = [$argument];
                    }
                    foreach ($argument as $address) {
                        $this->addAddress($address);
                    }
                    break;

                case ContactBirthday::class:
                    $this->setBirthday($argument);
                    break;

                case ContactEmail::class: // accepts an array of ContactEmail objects.
                    if (is_object($argument)) {
                        $argument = [$argument];
                    }
                    foreach ($argument as $email) {
                        $this->addEmail($email);
                    }
                    break;

                case ContactName::class:
                    $this->setName($argument);
                    break;

                case ContactOrganization::class:
                    $this->setOrganization($argument);
                    break;

                case ContactPhonenumber::class: // accepts an array of ContactPhonenumber objects.
                    if (is_object($argument)) {
                        $argument = [$argument];
                    }
                    foreach ($argument as $phonenumber) {
                        $this->addPhonenumber($phonenumber);
                    }
                    break;

                case ContactUrl::class: // accepts an array of ContactUrl objects.
                    if (is_object($argument)) {
                        $argument = [$argument];
                    }
                    foreach ($argument as $url) {
                        $this->addUrl($url);
                    }
                    break;

                default:
                    throw new ContactException('Unknown Argument Type ' . $argument);
            }
        }
    }

    /**
     * @param \CMText\RichContent\Common\ContactAddress $ContactAddress
     */
    public function addAddress(ContactAddress $ContactAddress)
    {
        $this->addresses[] = $ContactAddress;
    }

    /**
     * @param \CMText\RichContent\Common\ContactBirthday $ContactBirthday
     */
    public function setBirthday(ContactBirthday $ContactBirthday)
    {
        $this->birthday = $ContactBirthday;
    }

    /**
     * @param \CMText\RichContent\Common\ContactEmail $ContactEmail
     */
    public function addEmail(ContactEmail $ContactEmail)
    {
        $this->emails[] = $ContactEmail;
    }

    /**
     * @param \CMText\RichContent\Common\ContactName $ContactName
     */
    public function setName(ContactName $ContactName)
    {
        $this->name = $ContactName;
    }

    /**
     * @param \CMText\RichContent\Common\ContactOrganization $ContactOrganization
     */
    public function setOrganization(ContactOrganization $ContactOrganization)
    {
        $this->organization = $ContactOrganization;
    }

    /**
     * @param \CMText\RichContent\Common\ContactPhonenumber $ContactPhonenumber
     */
    public function addPhonenumber(ContactPhonenumber $ContactPhonenumber)
    {
        $this->phones[] = $ContactPhonenumber;
    }

    /**
     * @param \CMText\RichContent\Common\ContactUrl $ContactUrl
     */
    public function addUrl(ContactUrl $ContactUrl)
    {
        $this->urls[] = $ContactUrl;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        // none of the properties are required, so we filter the empty ones.
        return (object)array_filter([
            'addresses' => array_filter($this->addresses),
            'birthday' => $this->birthday,
            'emails' => array_filter($this->emails),
            'name' => $this->name,
            'org' => $this->organization,
            'phones' => array_filter($this->phones),
            'urls' => array_filter($this->urls),
        ]);
    }
}