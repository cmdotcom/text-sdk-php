<?php

namespace CMText\RichContent\Templates\Whatsapp;

use PHPUnit\Framework\TestCase;

class LocalizableParamCurrencyTest extends TestCase
{

    public function testJsonSerialize()
    {
        $currency = new LocalizableParamCurrency(
            '€20,20',
            'EUR',
            20200
        );

        $this->assertJson(
            json_encode($currency)
        );

        $this->assertObjectHasAttribute(
            'currency',
            json_decode( json_encode($currency) )
        );

        $this->assertObjectHasAttribute(
            'currency_code',
            (json_decode( json_encode($currency))->currency )
        );

        $this->assertObjectHasAttribute(
            'amount_1000',
            (json_decode( json_encode($currency))->currency )
        );
    }

    public function test__construct()
    {
        $currency = new LocalizableParamCurrency(
            '€50,11',
            'EUR',
            50110
        );

        $this->assertInstanceOf(
            LocalizableParamBase::class,
            $currency
        );
    }
}
