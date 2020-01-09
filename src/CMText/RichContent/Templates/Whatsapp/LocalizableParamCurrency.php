<?php


namespace CMText\RichContent\Templates\Whatsapp;


class LocalizableParamCurrency extends LocalizableParamBase
{
    /**
     * @var string CurrencyCode
     */
    private $code;

    /**
     * @var float Amount
     */
    private $amount;


    /**
     * LocalizableParamCurrency constructor.
     * @param string $Default the default text if localization fails
     * @param string $CurrencyCode currency-code like USD or EUR
     * @param float $Amount amount in 1000-fold , 50110 EUR becomes €50.11
     */
    public function __construct(
        string $Default,
        string $CurrencyCode,
        float $Amount
    )
    {
        parent::__construct($Default);

        $this->code = $CurrencyCode;
        $this->amount = $Amount;

        $this->setAdditional([
            'currency' => (object)[
                'currency_code' => $this->code,
                'amount_1000' => $this->amount,
            ]
        ]);
    }

}