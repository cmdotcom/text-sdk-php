<?php

namespace CMText\RichContent\Messages;

/**
 * Class CarouselMessage
 * @package CMText\RichContent\Messages
 */
class CarouselMessage implements IRichMessage
{

    /**
     * @var array List of Cards in carousel
     */
    private $cards;

    /**
     * @var string Size of Card in carousel as determined in \CMText\RichContent\CarouselCardWidth
     */
    private $cardWidth;


    /**
     * CarouselMessage constructor.
     * @param string $CardWidth
     * @param array $Cards
     */
    public function __construct(
        string $CardWidth = CarouselCardWidth::MEDIUM,
        array $Cards = []
    )
    {
        self::SetCardWidth($CardWidth);

        foreach ($Cards as $Card){
            self::AddCard($Card);
        }
    }


    /**
     * Add one CardMessage to the carousel
     * @param \CMText\RichContent\Messages\CardMessage $Card
     */
    public function AddCard(CardMessage $Card){
        $this->cards[] = $Card;
    }


    /**
     * Overwrite CardWidth setting
     * @param string $CardWidth
     */
    public function SetCardWidth(string $CardWidth)
    {
        $this->cardWidth = $CardWidth;
    }


    public function jsonSerialize()
    {
        return (object)[
            'carousel' => (object)[
                'cards'     => $this->cards,
                'cardWidth' => $this->cardWidth,
            ]
        ];
    }
}