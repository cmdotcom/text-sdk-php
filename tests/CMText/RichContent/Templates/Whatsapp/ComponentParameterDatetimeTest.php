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

        $json = json_decode(json_encode($componentParameter));

        $this->assertObjectHasAttribute(
            'date_time',
            $json
        );

        $this->assertObjectHasAttribute(
            'fallback_value',
            $json->date_time
        );

        $this->assertObjectHasAttribute(
            'timestamp',
            $json->date_time
        );

        $this->assertEquals(
            $datetime->getTimestamp(),
            $json->date_time->timestamp
        );
    }
}
