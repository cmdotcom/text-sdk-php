<?php


namespace CMText\RichContent\Templates\Whatsapp;


abstract class LocalizableParamBase implements \JsonSerializable
{

    /**
     * @var string Default text when localization fails.
     */
    private $default;

    /**
     * @var array Associative array with additional properties to append to the json-object-output
     */
    private $additonal;

    /**
     * LocalizableParamBase constructor.
     * @param string $Default
     */
    public function __construct(string $Default)
    {
        $this->default = $Default;
        $this->setAdditional([]);
    }


    protected function setAdditional(array $Addition)
    {
        $this->additonal = $Addition;
    }

    /**
     * @return object
     */
    public function jsonSerialize()
    {
        return (object)array_merge(
            [
                'default' => $this->default,
            ],
            $this->additonal
        );
    }

}