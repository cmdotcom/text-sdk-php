<?php

namespace CMText\RichContent\Common;

/**
 * Class ContactOrganization
 * @package CMText\RichContent\Common
 */
class ContactOrganization implements \JsonSerializable
{
    /**
     * @var string
     */
    private $company;

    /**
     * @var string
     */
    private $department;

    /**
     * @var string
     */
    private $title;

    /**
     * ContactOrganization constructor.
     * @param string $Company
     * @param string $Department
     * @param string $Title
     */
    public function __construct(
        string $Company = '',
        string $Department = '',
        string $Title = ''
    )
    {
        $this->company = $Company;
        $this->department = $Department;
        $this->title = $Title;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        // none of the properties are required, so we filter the empty ones.
        return (object)array_filter([
            'company' => $this->company,
            'department' => $this->department,
            'title' => $this->title,
        ]);
    }
}