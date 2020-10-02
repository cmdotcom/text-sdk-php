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
        $datetime = (new \DateTimeImmutable)->setTimestamp(
            rand(time(), time()*2)
        );

        $componentParameter = new ComponentParameterDatetime(
            $datetime->format(DATE_COOKIE),
            $datetime
        );

        $this->assertInstanceOf(
            ComponentParameterBase::class,
            $componentParameter
        );

        $this->assertObjectHasAttribute(
            'date_time',
            json_decode(json_encode($componentParameter))
        );

        $this->assertObjectHasAttribute(
            'fallback_value',
            (json_decode(json_encode($componentParameter)))->date_time
        );

        $this->assertObjectHasAttribute(
            'timestamp',
            (json_decode(json_encode($componentParameter)))->date_time
        );

        $this->assertAttributeEquals(
            $datetime->getTimestamp(),
            'timestamp',
            (json_decode(json_encode($componentParameter)))->date_time
        );
    }
}
