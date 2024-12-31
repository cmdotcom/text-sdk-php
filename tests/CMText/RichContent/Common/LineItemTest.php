<?php

namespace CMText\RichContent\Common;

use PHPUnit\Framework\TestCase;

class LineItemTest extends TestCase
{

    public function test__construct()
    {
        $lineitem = new \CMText\RichContent\Common\LineItem(
            'product-name',
            'final-or-pending',
            1
        );

        $json = json_decode(json_encode($lineitem));

        $this->assertTrue(
            property_exists($json, 'label')
        );

        $this->assertTrue(
            property_exists($json, 'type')
        );

        $this->assertTrue(
            property_exists($json, 'amount')
        );
    }
}
