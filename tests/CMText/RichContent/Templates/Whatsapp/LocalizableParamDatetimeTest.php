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
        $datetime = (new \DateTimeImmutable)->setTimestamp(
            rand(time(), time()*2)
        );

        $dt = new LocalizableParamDatetime(
            $datetime->format(DATE_COOKIE),
            $datetime
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

        $this->assertArraySubset(
            [
                'day_of_week' => $datetime->format('N'),
                'day_of_month' => $datetime->format('j'),
                'year' => $datetime->format('Y'),
                'month' => $datetime->format('n'),
                'hour' => $datetime->format('H'),
                'minute' => $datetime->format('i'),
            ],
            (array)(json_decode(json_encode($dt)))->date_time->component
        );
    }
}
