<?php

namespace CMText\RichContent\Common;

/**
 * Class ContactBirthday
 * @package CMText\RichContent\Common
 */
class ContactBirthday implements \JsonSerializable
{
    /**
     * @var \DateTimeInterface
     */
    private $date;

    /**
     * ContactBirthday constructor.
     * @param \DateTimeInterface $Birthday
     */
    public function __construct(\DateTimeInterface $Birthday)
    {
        $this->date = $Birthday;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return $this->date->format('Y-m-d');
    }
}