<?php

namespace CMText\RichContent\Templates\Whatsapp;

use PHPUnit\Framework\TestCase;

class ComponentParameterDatetimeTest extends TestCase
{

    public function test__construct()
    {
        $this->assertJson(
            json_encode(
                new ComponentParameterDatetime(
                    'right now',
                    new \DateTime()
                )
            )
        );
    }

    public function testJsonSerialize()
    {
        $datetime = new \DateTimeImmutable();

        $componentParameter = new ComponentParameterDatetime(
            $datetime->format(DATE_COOKIE),
            $datetime
        );

        $this->assertInstanceOf(
            ComponentParameterBase::class,
            $componentParameter
        );

        $json = json_decode(json_encode($componentParameter));

        $this->assertTrue(
            property_exists($json, 'date_time')
        );

        $this->assertTrue(
            property_exists($json->date_time, 'fallback_value')
        );

        $this->assertTrue(
            property_exists($json->date_time, 'timestamp')
        );

        $this->assertEquals(
            $datetime->getTimestamp(),
            $json->date_time->timestamp
        );
    }
}
