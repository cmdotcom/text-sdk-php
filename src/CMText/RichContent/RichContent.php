<?php
namespace CMText\RichContent;


use CMText\Exceptions\ConversationLimitException;
use CMText\Exceptions\SuggestionsLimitException;
use CMText\RichContent\Messages\IRichMessage;
use CMText\RichContent\Suggestions\ISuggestion;

/**
 * Class RichContent
 * @package CMText\RichContent
 */
class RichContent implements \JsonSerializable
{

    /**
     * @var array List of Conversation parts
     */
    private $conversation = [];

    /**
     * @var array List of Suggestion parts
     */
    private $suggestions = [];

    /**
     * Maximum amount of allowed Conversation parts
     */
    const CONVERSATION_LENGTH_LIMIT = 5;

    /**
     * Maximum amount of allowed Suggestion parts
     */
    const SUGGESTIONS_LENGTH_LIMIT = 11;


    /**
     * Add a RichMessage to the Conversation
     * @param \CMText\RichContent\Messages\IRichMessage $richMessage
     * @throws \CMText\Exceptions\ConversationLimitException
     */
    public function AddConversationPart(IRichMessage $richMessage)
    {
        $this->conversation[] = $richMessage;

        if(count($this->conversation) > self::CONVERSATION_LENGTH_LIMIT){
            throw new ConversationLimitException();
        }
    }


    /**
     * Add a Suggestion to the list of suggestions
     * @param \CMText\RichContent\Suggestions\ISuggestion $suggestion
     * @throws \CMText\Exceptions\SuggestionsLimitException
     */
    public function AddSuggestion(ISuggestion $suggestion)
    {
        $this->suggestions[] = $suggestion;

        if(count($this->suggestions) > self::SUGGESTIONS_LENGTH_LIMIT){
            throw new SuggestionsLimitException();
        }
    }


    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return (object)array_filter([
            'conversation' => $this->conversation,
            'suggestions'  => $this->suggestions
        ]);
    }
}
