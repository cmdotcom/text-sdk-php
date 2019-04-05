<?php

namespace CMText\RichContent\Suggestions;

/**
 * Class SuggestionBase
 * @package CMText\RichContent\Suggestions
 */
abstract class SuggestionBase implements ISuggestion
{

    /**
     * @var string Action command for a Suggestion.
     */
    protected $action;

    /**
     * @var string Text the end user will see.
     */
    protected $label;


    abstract public function jsonSerialize();
}