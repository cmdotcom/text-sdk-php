<?php


namespace CMText\RichContent\Common;


class LineItem implements \JsonSerializable
{
    /**
     * (Required) A short, localized description of the line item.
     * @var string
     */
    public $label;

    /**
     * A value that indicates whether the line item is final or pending.
     * @var string
     */
    public $type;

    /**
     * (Required) The monetary amount of the line item.
     * @var float
     */
    public $amount;

    /**
     * LineItem constructor.
     * @param string $Label
     * @param string $Type
     * @param float $Amount
     */
    public function __construct(
        string $Label,
        string $Type,
        float $Amount
    )
    {
        $this->label = $Label;
        $this->type = $Type;
        $this->amount = $Amount;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return $this;
    }
}
