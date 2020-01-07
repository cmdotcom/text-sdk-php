<?php

namespace CMText\RichContent\Common;

use CMText\Exceptions\ContactAddressException;

/**
 * Class ContactAddress
 * @package CMText\RichContent\Common
 */
class ContactAddress implements \JsonSerializable
{
    /**
     * @var string
     */
    private $city;

    /**
     * @var string
     */
    private $country;

    /**
     * @var string
     */
    private $country_code;

    /**
     * @var string
     */
    private $state;

    /**
     * @var string
     */
    private $street;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $zip;

    const COUNTRYCODE_MAX_LENGTH = 3;

    /**
     * ContactAddress constructor.
     * @param string $City
     * @param string $Country
     * @param string $CountryCode
     * @param string $State
     * @param string $Street
     * @param string $Type
     * @param string $Zip
     * @throws \CMText\Exceptions\ContactAddressException
     */
    public function __construct(
        string $City = '',
        string $Country = '',
        string $CountryCode = '',
        string $State = '',
        string $Street = '',
        string $Type = '',
        string $Zip = ''
    )
    {
        if (strlen($CountryCode) > self::COUNTRYCODE_MAX_LENGTH) {
            throw new ContactAddressException('Invalid CountryCode');
        }

        if (!in_array(
            $Type,
            [
                ContactAddressTypes::HOME,
                ContactAddressTypes::WORK,
                '', // no value provided is allowed as well
            ]
        )) {
            throw new ContactAddressException('Unknown ContactAddress Type');
        }

        $this->city = $City;
        $this->country = $Country;
        $this->country_code = $CountryCode;
        $this->state = $State;
        $this->street = $Street;
        $this->type = $Type;
        $this->zip = $Zip;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        // none of these properties are required, so we filter the empty ones.
        return (object)array_filter([
            'city' => $this->city,
            'country' => $this->country,
            'country_code' => $this->country_code,
            'state' => $this->state,
            'street' => $this->street,
            'type' => $this->type,
            'zip' => $this->zip,
        ]);
    }
}