<?php

namespace CMText\RichContent\Common;

use CMText\Exceptions\ContactUrlException;

/**
 * Class ContactUrl
 * @package CMText\RichContent\Common
 */
class ContactUrl implements \JsonSerializable
{
    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $type;

    /**
     * ContactUrl constructor.
     * @param string $Url
     * @param string $Type
     * @throws \CMText\Exceptions\ContactUrlException
     */
    public function __construct(string $Url, string $ContactUrlType = '')
    {
        if(!filter_var($Url, FILTER_VALIDATE_URL)){
            throw new ContactUrlException('Invalid Url');
        }

        $this->type = $ContactUrlType;
        $this->url  = $Url;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        // none of the properties are required, so we filter the empty ones.
        return (object)array_filter([
            'url' => $this->url,
            'type' => $this->type,
        ]);
    }
}