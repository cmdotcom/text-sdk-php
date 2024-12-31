<?php

namespace CMText\RichContent\Payments;

use PHPUnit\Framework\TestCase;

class ApplePayConfigurationTest extends TestCase
{

    public function test__construct()
    {
        $configuration = new ApplePayConfiguration(
            'merchant-name',
            'product-description',
            'unique-order-guid',
            1,
            'currency-code',
            'recipient-email',
            'recipient-country-code',
            'language-country-code',
            true,
            true,
            [
                new \CMText\RichContent\Common\LineItem(
                    'product-name',
                    'final-or-pending',
                    1
                )
            ]
        );

        $json = json_decode(json_encode($configuration));

        $this->assertTrue(
            property_exists($json, 'merchantName')
        );

        $this->assertTrue(
            property_exists($json, 'description')
        );

        $this->assertTrue(
            property_exists($json, 'orderReference')
        );

        $this->assertTrue(
            property_exists($json, 'total')
        );

        $this->assertTrue(
            property_exists($json, 'currencyCode')
        );

        $this->assertTrue(
            property_exists($json, 'recipientEmail')
        );

        $this->assertTrue(
            property_exists($json, 'recipientCountryCode')
        );

        $this->assertTrue(
            property_exists($json, 'languageCountryCode')
        );

        $this->assertTrue(
            property_exists($json, 'billingAddressRequired')
        );

        $this->assertTrue(
            property_exists($json, 'shippingContactRequired')
        );

        $this->assertTrue(
            property_exists($json, 'lineItems')
        );
    }
}
