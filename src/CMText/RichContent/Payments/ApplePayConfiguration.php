<?php


namespace CMText\RichContent\Payments;


class ApplePayConfiguration extends PaymentConfigurationBase
{
    /**
     * (Required) A unique identifier that represents a merchant for Apple Pay.
     * @var string
     */
    public $merchantName;

    /**
     * (Required) Description of the item being bought.
     * @var string
     */
    public $description;

    /**
     * (Required) A unique identifier that represents a order
     * @var $string
     */
    public $orderReference;

    /**
     * @inheritdoc
     */
    public $lineItems;

    /**
     * A dictionary containing the total.
     * @var float
     */
    public $total;

    /**
     * Email address of the Apple Pay contact.
     * @var string
     */
    public $recipientEmail;

    /**
     * Value indicating the currency code of the apple pay request
     * @var string
     */
    public $currencyCode;

    /**
     * Country of the Apple Pay contact.
     * @var string
     */
    public $recipientCountryCode;

    /**
     * The Language of the Country of the Apple Pay Contact
     * @var string
     */
    public $languageCountryCode;

    /**
     * Value indicating that a billing address is required
     * @var boolean
     */
    public $billingAddressRequired;

    /**
     * Value indicating that a shipping contact is required
     * @var boolean
     */
    public $shippingContactRequired;

    /**
     * ApplePayConfiguration constructor.
     * @param string $merchantName
     * @param string $description
     * @param string $orderReference
     * @param float $total
     * @param string $currencyCode
     * @param string $recipientEmail
     * @param string $recipientCountryCode
     * @param string $languageCountryCode
     * @param bool $billingAddressRequired
     * @param bool $shippingContactRequired
     * @param array $lineItems
     */
    public function __construct(
        string $merchantName,
        string $description,
        string $orderReference,
        float $total,
        string $currencyCode,
        string $recipientEmail,
        string $recipientCountryCode,
        string $languageCountryCode,
        bool $billingAddressRequired,
        bool $shippingContactRequired,
        array $lineItems
    )
    {
        $this->merchantName = $merchantName;
        $this->description = $description;
        $this->orderReference = $orderReference;
        $this->total = $total;
        $this->currencyCode = $currencyCode;
        $this->recipientEmail = $recipientEmail;
        $this->recipientCountryCode = $recipientCountryCode;
        $this->languageCountryCode = $languageCountryCode;
        $this->billingAddressRequired = $billingAddressRequired;
        $this->shippingContactRequired = $shippingContactRequired;

        foreach ($lineItems as $lineItem) {
            $this->addLineItem($lineItem);
        }
    }
}
