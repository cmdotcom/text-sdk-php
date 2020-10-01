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

        $this->assertObjectHasAttribute(
            'merchantName',
            $json
        );

        $this->assertObjectHasAttribute(
            'description',
            $json
        );

        $this->assertObjectHasAttribute(
            'orderReference',
            $json
        );

        $this->assertObjectHasAttribute(
            'total',
            $json
        );

        $this->assertObjectHasAttribute(
            'currencyCode',
            $json
        );

        $this->assertObjectHasAttribute(
            'recipientEmail',
            $json
        );

        $this->assertObjectHasAttribute(
            'recipientCountryCode',
            $json
        );

        $this->assertObjectHasAttribute(
            'languageCountryCode',
            $json
        );

        $this->assertObjectHasAttribute(
            'billingAddressRequired',
            $json
        );

        $this->assertObjectHasAttribute(
            'shippingContactRequired',
            $json
        );

        $this->assertObjectHasAttribute(
            'lineItems',
            $json
        );
    }
}
