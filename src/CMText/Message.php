<?php

namespace CMText;


use CMText\Exceptions\RecipientLimitException;
use CMText\RichContent\Messages\IRichMessage;
use CMText\RichContent\Messages\PaymentMessage;
use CMText\RichContent\Messages\TemplateMessage;
use CMText\RichContent\RichContent;
use JsonSerializable;

/**
 * Class Message
 *
 * @package CMText
 */
class Message implements JsonSerializable
{

    /**
     * @var \CMText\MessageBody
     */
    private $body;

    /**
     * @var string Grouping field for message statistics
     */
    private $customgrouping3;

    /**
     * @var string Sender name
     * @note Twitter requires the snowflake-id of the account you want to use as sender
     */
    private $from;

    /**
     * @var string Reference for message lookup and identification
     */
    private $reference;

    /**
     * @var array List of Recipients
     * @note Twitter requires the snowflake-id
     */
    private $to = [];

    /**
     * @var int Minimum number of message parts for SMS concatenation
     */
    private $minimumNumberOfMessageParts;

    /**
     * @var int Maximum number of message parts for SMS concatenation
     */
    private $maximumNumberOfMessageParts;

    /**
     * @var string Hybrid App Key for use with CM Hybrid Messaging product
     */
    private $hybridAppKey;

    /**
     * @var array Channels that are exclusively used for delivering this message.
     */
    private $allowedChannels = [];

    /**
     * @var RichContent
     */
    private $richContent;

    /**
     * Fallback value for Sender
     */
    const SENDER_FALLBACK = 'cm.com';

    /**
     * Default values for Minimum and Maximum amount of message parts
     */
    const MESSAGEPARTS_MINIMUM = 1;
    const MESSAGEPARTS_MAXIMUM = 8;

    /**
     * Recipients limit per request
     */
    const RECIPIENTS_MAXIMUM = 1000;


    /**
     * Message constructor.
     *
     * @param string $body
     * @param string|null $from
     * @param array $to
     * @param string|null $reference
     * @throws \CMText\Exceptions\RecipientLimitException
     */
    public function __construct(string $body = '', string $from = null, array $to = [], string $reference = null)
    {
        $this->body = new MessageBody($body);
        $this->from = $from ?? self::SENDER_FALLBACK;
        $this->reference = $reference;
        self::AddRecipients($to);

        $this->minimumNumberOfMessageParts = self::MESSAGEPARTS_MINIMUM;
        $this->maximumNumberOfMessageParts = self::MESSAGEPARTS_MAXIMUM;

        $this->customgrouping3 = 'text-sdk-php-' . TextClient::VERSION;
    }


    /**
     * Setters for a limited set of properties
     * @param string $name
     * @param mixed $value
     * @throws \CMText\Exceptions\RecipientLimitException
     */
    public function __set(string $name, $value)
    {
        switch ($name){
            case 'body':
                $this->body = new MessageBody($value);
                break;

            case 'from':
            case 'minimumNumberOfMessageParts':
            case 'maximumNumberOfMessageParts':
            case 'reference':
                $this->{$name} = $value;
                break;

            case 'to':
                $this->AddRecipients($value);
                break;
        }
    }


    /**
     * Add an array of Recipients
     * @param array $Recipients
     * @return array
     * @throws \CMText\Exceptions\RecipientLimitException
     */
    public function AddRecipients(array $Recipients)
    {
        if( (count($Recipients) + count($this->to)) > self::RECIPIENTS_MAXIMUM){
            throw new RecipientLimitException('Maximum amount of Recipients exceeded. ('. self::RECIPIENTS_MAXIMUM .')');
        }

        return $this->to = array_merge([], $Recipients, $this->to);
    }


    /**
     * Force a message to use only the provided set of Channels by setting this.
     * @param array $Channels
     * @return $this
     */
    public function WithChannels(array $Channels)
    {
        $supportedChannels = array_intersect(
            (new \ReflectionClass(Channels::class))->getConstants(),
            $Channels
        );

        $this->allowedChannels = array_unique(array_merge($this->allowedChannels, array_values($supportedChannels)));

        return $this;
    }


    /**
     * Add a RichContent message which replaces the Body for channels that support rich content.
     * @param \CMText\RichContent\Messages\IRichMessage $richMessage
     * @return $this
     * @throws \CMText\Exceptions\ConversationLimitException
     */
    public function WithRichMessage(IRichMessage $richMessage){
        if(null === $this->richContent){
            $this->richContent = new RichContent();
        }

        $this->richContent->AddConversationPart($richMessage);
        return $this;
    }


    /**
     * Add a Suggestion to a message. Supported Suggestion types depend on the Channel used.
     * @param $suggestions
     * @return $this
     * @throws \CMText\Exceptions\SuggestionsLimitException
     */
    public function WithSuggestions(array $suggestions){
        if(null === $this->richContent){
            $this->richContent = new RichContent();
        }

        foreach ($suggestions as $suggestion){
            $this->richContent->AddSuggestion($suggestion);
        }

        return $this;
    }


    /**
     * Set your Hybrid App Key.
     * @param string $Key
     * @return $this
     */
    public function WithHybridAppKey(string $Key)
    {
        $this->hybridAppKey = $Key;
        return $this;
    }


    /**
     * @param \CMText\RichContent\Messages\TemplateMessage $template
     * @return $this
     * @throws \CMText\Exceptions\ConversationLimitException
     */
    public function WithTemplate(TemplateMessage $template)
    {
        if( !$this->richContent ){
            $this->richContent = new RichContent();
        }

        $this->richContent->AddConversationPart($template);
        return $this;
    }


    /**
     * @param \CMText\RichContent\Messages\PaymentMessage $paymentMessage
     * @return $this
     * @throws \CMText\Exceptions\ConversationLimitException
     */
    public function WithPayment(PaymentMessage $paymentMessage)
    {
        if( !$this->richContent ){
            $this->richContent = new RichContent();
        }

        $this->richContent->AddConversationPart($paymentMessage);
        return $this;
    }


    /**
     * @return object
     */
    public function jsonSerialize()
    {
        $return = [
            'body'      => $this->body,
            'from'      => $this->from,
            'to'        => array_map(function ($number){
                return (object)[
                    'number' => $number,
                ];
            }, $this->to),
            'customgrouping3' => $this->customgrouping3,
            'minimumNumberOfMessageParts' => $this->minimumNumberOfMessageParts,
            'maximumNumberOfMessageParts' => $this->maximumNumberOfMessageParts,
        ];

        if( count($this->allowedChannels) ){
            $return['allowedChannels'] = $this->allowedChannels;
        }

        if( null !== $this->hybridAppKey ){
            $return['appKey'] = $this->hybridAppKey;
        }

        if( null !== $this->richContent ){
            $return['richContent'] = $this->richContent;
        }

        if( null !== $this->reference ){
            $return['reference'] = $this->reference;
        }

        return (object)$return;
    }
}
