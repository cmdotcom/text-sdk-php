<?php


namespace CMText\RichContent\Payments;


use CMText\RichContent\Common\LineItem;
use JsonSerializable;

abstract class PaymentConfigurationBase implements JsonSerializable
{
    /**
     * An array of line items explaining payments and additional charges.
     * @var \CMText\RichContent\Common\LineItem[]
     */
    public $lineItems;

    /**
     * Add a LineItem to the PaymentConfiguration
     * @param \CMText\RichContent\Common\LineItem $lineItem
     */
    public function addLineItem(LineItem $lineItem)
    {
        $this->lineItems[] = $lineItem;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return $this;
    }
}
