<?php

namespace CMText\RichContent\Common;

/**
 * Class ContactName
 * @package CMText\RichContent\Common
 */
class ContactName implements \JsonSerializable
{
    /**
     * @var string
     */
    private $formatted = '';

    /**
     * @var string
     */
    private $first;

    /**
     * @var string
     */
    private $last;

    /**
     * @var string
     */
    private $middle;

    /**
     * @var string
     */
    private $prefix;

    /**
     * @var string
     */
    private $suffix;

    /**
     * ContactName constructor.
     * @param string $FormattedName
     * @param string $FirstName
     * @param string $LastName
     * @param string $MiddleName
     * @param string $NamePrefix
     * @param string $NameSuffix
     */
    public function __construct(
        string $FormattedName,
        string $FirstName = '',
        string $LastName = '',
        string $MiddleName = '',
        string $NamePrefix = '',
        string $NameSuffix = ''
    )
    {
        $this->formatted = $FormattedName;
        $this->first = $FirstName;
        $this->last = $LastName;
        $this->middle = $MiddleName;
        $this->prefix = $NamePrefix;
        $this->suffix = $NameSuffix;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return (object)array_merge(
            [
                // required property
                'formatted_name' => $this->formatted,
            ], array_filter([
                // optional properties
                'first_name' => $this->first,
                'last_name' => $this->last,
                'middle_name' => $this->middle,
                'name_prefix' => $this->prefix,
                'name_suffix' => $this->suffix,
            ])
        );
    }
}