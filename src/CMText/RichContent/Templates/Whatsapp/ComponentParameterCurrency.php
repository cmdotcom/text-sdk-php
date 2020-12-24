<?php

namespace CMText\RichContent\Templates\Whatsapp;


use stdClass;


class ComponentParameterCurrency extends ComponentParameterBase
{
    /**
     * @inheritdoc
     */
    const TYPE = 'currency';

    /**
     * The Currency object
     * @var stdClass
     */
    public $currency;

    /**
     * ComponentParameterCurrency constructor.
     * @param string $fallback_value The string to be used when currency formatting fails
     * @param string $code The currency-code like EUR or USD
     * @param float $amount_1000 The amount in currency-code times 1000 (20210 for $20.21)
     */
    public function __construct(
        string $fallback_value,
        string $code,
        float $amount_1000
    )
    {
        parent::__construct(self::TYPE);

        $this->currency = new stdClass();
        $this->currency->fallback_value = $fallback_value;
        $this->currency->code = $code;
        $this->currency->amount_1000 = $amount_1000;
    }

}