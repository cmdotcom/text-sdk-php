<?php

namespace CMText\RichContent\Templates\Whatsapp;

use PHPUnit\Framework\TestCase;

class LocalizableParamDatetimeTest extends TestCase
{

    public function test__construct()
    {
        $this->assertJson(
            json_encode(
                new LocalizableParamDatetime(
                    'right now',
                    new \DateTime()
                )
            )
        );
    }

    public function testJsonSerialize()
    {
        $dt = new LocalizableParamDatetime(
            'right now',
            new \DateTime()
        );

        $this->assertInstanceOf(
            LocalizableParamBase::class,
            $dt
        );

        $this->assertObjectHasAttribute(
            'date_time',
            json_decode(json_encode($dt))
        );

        $this->assertObjectHasAttribute(
            'component',
            (json_decode(json_encode($dt)))->date_time
        );

        $this->assertObjectHasAttribute(
            'day_of_month',
            (json_decode(json_encode($dt)))->date_time->component
        );
    }
}
