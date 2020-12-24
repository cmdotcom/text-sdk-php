<?php


use PHPUnit\Framework\TestCase;

class SuggestionsTest extends TestCase
{

    public function testBaseClassProperties()
    {
        $this->assertClassHasAttribute(
            'action',
            \CMText\RichContent\Suggestions\SuggestionBase::class
        );

        $this->assertClassHasAttribute(
            'label',
            \CMText\RichContent\Suggestions\SuggestionBase::class
        );
    }


    public function testCalendarSuggestion()
    {
        $calendar = new \CMText\RichContent\Suggestions\CalendarSuggestion(
            'test label',
            new \CMText\RichContent\Suggestions\CalendarOptions(
                new DateTimeImmutable('2019-12-31T23:59:59+0000'),
                new DateTimeImmutable('2020-01-01T01:01:01+0000'),
                'test title',
                'test description'
            )
        );


        $this->assertJson( json_encode($calendar) );

        $this->assertInstanceOf(
            \CMText\RichContent\Suggestions\CalendarSuggestion::class,
            $calendar
        );

        $json = json_decode( json_encode($calendar) );

        $this->assertObjectHasAttribute(
            'calendar',
            $json
        );

        $this->assertObjectHasAttribute(
            'startTime',
            $json->calendar
        );
        $this->assertObjectHasAttribute(
            'endTime',
            $json->calendar
        );
        $this->assertObjectHasAttribute(
            'title',
            $json->calendar
        );
        $this->assertObjectHasAttribute(
            'description',
            $json->calendar
        );
    }


    public function testDialSuggestion()
    {
        $dial = new \CMText\RichContent\Suggestions\DialSuggestion(
            'test label',
            '+334455667788'
        );


        $this->assertJson( json_encode($dial) );

        $this->assertInstanceOf(
            \CMText\RichContent\Suggestions\DialSuggestion::class,
            $dial
        );

        $json = json_decode( json_encode($dial) );

        $this->assertObjectHasAttribute(
            'dial',
            $json
        );

        $this->assertObjectHasAttribute(
            'PhoneNumber',
            $json->dial
        );

    }


    public function testOpenUrlSuggestion()
    {
        $openUrl = new \CMText\RichContent\Suggestions\OpenUrlSuggestion(
            'test Label',
            'test://url'
        );


        $this->assertJson( json_encode($openUrl) );

        $this->assertInstanceOf(
            \CMText\RichContent\Suggestions\OpenUrlSuggestion::class,
            $openUrl
        );

        $this->assertObjectHasAttribute(
            'url',
            json_decode( json_encode($openUrl) )
        );
    }


    public function testReplySuggestion()
    {
        $reply = new \CMText\RichContent\Suggestions\ReplySuggestion(
            'test label',
            'test reply text'
        );


        $this->assertJson( json_encode($reply) );

        $this->assertInstanceOf(
            \CMText\RichContent\Suggestions\ReplySuggestion::class,
            $reply
        );

        $this->assertObjectHasAttribute(
            'postbackdata',
            json_decode( json_encode($reply) )
        );
    }


    public function testViewLocationSuggestion()
    {
        $viewStaticLocation = new \CMText\RichContent\Suggestions\ViewLocationSuggestion(
            'test label',
            new \CMText\RichContent\Common\ViewLocationStatic(
                'CM HQ',
                '51.603802',
                '4.770821'
            )
        );

        $this->assertJson( json_encode($viewStaticLocation) );

        $this->assertInstanceOf(
            \CMText\RichContent\Suggestions\ViewLocationSuggestion::class,
            $viewStaticLocation
        );

        $json = json_decode( json_encode($viewStaticLocation) );

        $this->assertObjectHasAttribute(
            'viewLocation',
            $json
        );

        $this->assertObjectHasAttribute(
            'latitude',
            $json->viewLocation
        );
        $this->assertObjectHasAttribute(
            'longitude',
            $json->viewLocation
        );
        $this->assertObjectHasAttribute(
            'label',
            $json->viewLocation
        );
        $this->assertObjectNotHasAttribute(
            'radius',
            $json->viewLocation
        );


        $viewDynamicLocation = new \CMText\RichContent\Suggestions\ViewLocationSuggestion(
            'test label',
            new \CMText\RichContent\Common\ViewLocationDynamic(
                'CM HQ',
                'Konijnenberg 30, Breda',
                5
            )
        );

        $this->assertJson( json_encode($viewDynamicLocation) );

        $this->assertInstanceOf(
            \CMText\RichContent\Suggestions\ViewLocationSuggestion::class,
            $viewDynamicLocation
        );

        $json = json_decode( json_encode($viewDynamicLocation) );

        $this->assertObjectHasAttribute(
            'viewLocation',
            $json
        );

        $this->assertObjectHasAttribute(
            'label',
            $json->viewLocation
        );
        $this->assertObjectHasAttribute(
            'searchQuery',
            $json->viewLocation
        );
        $this->assertObjectHasAttribute(
            'radius',
            $json->viewLocation
        );
    }


    public function testApplySuggestionToRichContent()
    {
        try {
            $richContent = new \CMText\RichContent\RichContent();
            $richContent->AddSuggestion(
                new \CMText\RichContent\Suggestions\DialSuggestion(
                    'test Label',
                    '+334455667788'
                )
            );

            $this->assertInstanceOf(
                \CMText\RichContent\RichContent::class,
                $richContent
            );

            $this->assertJson( json_encode($richContent) );

            $json = json_decode( json_encode($richContent) );

            $this->assertCount(
                1,
                $json->suggestions
            );


            //  add too many Conversation parts
            for($i = 0; $i < \CMText\RichContent\RichContent::SUGGESTIONS_LENGTH_LIMIT; ++$i){
                $richContent->AddSuggestion(
                    new \CMText\RichContent\Suggestions\DialSuggestion(
                        'test Label',
                        '+334455667788'
                    )
                );
            }

        }catch (\CMText\Exceptions\SuggestionsLimitException $suggestionsLengthException){
            $this->assertInstanceOf(
                \CMText\Exceptions\SuggestionsLimitException::class,
                $suggestionsLengthException
            );
        }
    }

}
