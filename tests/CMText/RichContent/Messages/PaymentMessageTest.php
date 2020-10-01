<?php

namespace CMText\RichContent\Messages;

use CMText\RichContent\Payments\ApplePayConfiguration;
use PHPUnit\Framework\TestCase;

class PaymentMessageTest extends TestCase
{

    public function test__construct()
    {
        $message = new PaymentMessage(
            new ApplePayConfiguration(
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
            )
        );

        $json = json_decode(json_encode($message));

        $this->assertObjectHasAttribute(
            'payment',
            $json
        );
    }
}
