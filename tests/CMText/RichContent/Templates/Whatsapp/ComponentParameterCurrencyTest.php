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

        $json = json_decode( json_encode($currency) );

        $this->assertObjectHasAttribute(
            'currency',
            $json
        );

        $this->assertObjectHasAttribute(
            'code',
            $json->currency
        );

        $this->assertObjectHasAttribute(
            'amount_1000',
            $json->currency
        );

        $this->assertEquals(
            20200,
            $json->currency->amount_1000
        );

        $this->assertObjectHasAttribute(
            'fallback_value',
            $json->currency
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
