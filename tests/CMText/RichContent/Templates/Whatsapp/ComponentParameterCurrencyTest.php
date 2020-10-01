<?php

namespace CMText\RichContent\Templates\Whatsapp;

use PHPUnit\Framework\TestCase;

class ComponentParameterCurrencyTest extends TestCase
{

    public function testJsonSerialize()
    {
        $currency = new ComponentParameterCurrency(
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
            'code',
            (json_decode( json_encode($currency))->currency )
        );

        $this->assertObjectHasAttribute(
            'amount_1000',
            (json_decode( json_encode($currency))->currency )
        );

        $this->assertObjectHasAttribute(
            'fallback_value',
            (json_decode( json_encode($currency))->currency )
        );
    }

    public function test__construct()
    {
        $currency = new ComponentParameterCurrency(
            '€50,11',
            'EUR',
            50110
        );

        $this->assertInstanceOf(
            ComponentParameterBase::class,
            $currency
        );
    }
}
