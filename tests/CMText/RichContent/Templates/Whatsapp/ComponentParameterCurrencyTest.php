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

        $this->assertTrue(
            property_exists($json, 'currency')
        );

        $this->assertTrue(
            property_exists($json->currency, 'code')
        );

        $this->assertTrue(
            property_exists($json->currency, 'amount_1000')
        );

        $this->assertEquals(
            20200,
            $json->currency->amount_1000
        );

        $this->assertTrue(
            property_exists($json->currency, 'fallback_value')
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
