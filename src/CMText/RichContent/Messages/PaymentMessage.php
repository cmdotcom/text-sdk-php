<?php


namespace CMText\RichContent\Messages;


use CMText\RichContent\Payments\PaymentConfigurationBase;


class PaymentMessage implements IRichMessage
{
    /**
     * The PaymentConfiguration
     * @var \CMText\RichContent\Payments\PaymentConfigurationBase
     */
    public $payment;

    /**
     * PaymentMessage constructor.
     * @param \CMText\RichContent\Payments\PaymentConfigurationBase $PaymentConfiguration
     */
    public function __construct(PaymentConfigurationBase $PaymentConfiguration)
    {
        $this->payment = $PaymentConfiguration;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return $this;
    }
}
