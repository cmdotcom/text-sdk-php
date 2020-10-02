<?php

namespace CMText\RichContent\Templates\Whatsapp;


use CMText\Exceptions\WhatsappTemplateComponentParameterTypeException;


abstract class ComponentBase implements \JsonSerializable
{
    /**
     * The Type of the Component
     * @const
     */
    const TYPE = self::class;

    /**
     * To expose the Component type
     * @var string
     */
    public $type;

    /**
     * To expose the Component Parameters
     * @var array $parameters
     */
    public $parameters = [];

    /**
     * The ComponentParameter-types supported by this Component
     * @var array $supportedParameterTypes
     */
    protected $supportedParameterTypes = [];

    /**
     * ComponentBase constructor.
     * @param string $type
     * @param array $parameters
     * @throws WhatsappTemplateComponentParameterTypeException
     */
    public function __construct(
        string $type,
        array $parameters = []
    )
    {
        $this->type = $type;

        foreach ($parameters as $parameter){
            $this->addParameter($parameter);
        }
    }

    /**
     * Add one ComponentParameter to the current set of ComponentParameters
     * @param ComponentParameterBase $parameter
     * @throws WhatsappTemplateComponentParameterTypeException
     */
    public function addParameter(ComponentParameterBase $parameter)
    {
        if ($this->supportsParameterType($parameter)) {
            $this->parameters[] = $parameter;
        }
    }

    /**
     * Checks if the given ComponentParameter is supported by the Component
     * @param ComponentParameterBase $parameter
     * @return bool
     * @throws WhatsappTemplateComponentParameterTypeException
     */
    private function supportsParameterType(ComponentParameterBase $parameter)
    {
        if (in_array($parameter->type, $this->supportedParameterTypes)) {
            return true;
        } else {
            throw new WhatsappTemplateComponentParameterTypeException('Parameter-type '. $parameter->type .' not supported in Component-type '. $this->type);
        }
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return $this;
    }
}