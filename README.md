[![Build Status](https://travis-ci.com/cmdotcom/text-sdk-php.svg?branch=master)](https://travis-ci.com/cmdotcom/text-sdk-php)
[![codecov](https://codecov.io/gh/cmdotcom/text-sdk-php/branch/master/graph/badge.svg)](https://codecov.io/gh/cmdotcom/text-sdk-php)
[![Packagist](https://img.shields.io/packagist/dm/cmdotcom/text-sdk-php)](https://packagist.org/packages/cmdotcom/text-sdk-php)

# CM Text SDK
A software development kit to provide ways to interact with CM.com's Text service. API used:
- [Business Messaging](https://docs.cmtelecom.com/business-messaging/v1.0)


### Requirements

- php 7.* or 8.0 or 8.1 or 8.2


## Usage

### Instantiate the client
Using your unique `ApiKey` (or product token) which authorizes you on the CM platform. Always keep this key secret!

The product token can be found in the [Channels](https://www.cm.com/app/channels) application on the platform, under the `Gateway` section.

```php
$client = new \CMText\TextClient('your-api-key');
```

### Send a message
By calling `SendMessage` and providing message text, sender name, recipient phone number(s) and a reference (optional).

```php
$result = $client->SendMessage('Message_Text', 'CM.com', [ 'Recipient_PhoneNumber' ], 'Your_Reference');
```

### Get the result
`SendMessage` and `send` return an object of type `TextClientResult`, example:

```json
{
  "statusMessage": "Created 1 message(s)",
  "statusCode": 201,
  "details": [
    {
      "reference": "Example_Reference",
      "status": "Accepted",
      "to": "Example_PhoneNumber",
      "parts": 1,
      "details": null
    },
    {
      "reference": "Example_Reference2",
      "status": "Rejected",
      "to": "Example_PhoneNumber2",
      "parts": 0,
      "details": "A body without content was found"
    }
  ]
}
```

### Status codes
For all possibly returned status codes, please reference the `TextClientStatusCodes` class.

### Sending a rich message
By using the `Message` class it is possible to create messages with media for channels such as WhatsApp and RCS
```php
$client = new TextClient('your-api-key');
$message = new Message('Message Text', 'Sender_name', ['Recipient_PhoneNumber']);
$message
    ->WithChannels([Channels::WHATSAPP])
    ->WithHybridAppKey('your-secret-hybrid-app-key')
    ->WithRichMessage(
        new MediaMessage(
            'cm.com',
            'https://avatars3.githubusercontent.com/u/8234794?s=200&v=4',
            'image/png'
        )
    )
    ->WithSuggestions([
        new ReplySuggestion('Opt In', 'OK'),
        new ReplySuggestion('Opt Out', 'STOP'),
    ]);
$result = $client->send( [$message] );
```

## Sending a WhatsApp template message
By using the `Message` class it is possible to create template messages. Please note that this is WhatsApp only and your template needs to be approved before sending.
For more info please check our documentation: https://docs.cmtelecom.com/en/api/business-messaging-api/1.0/index#whatsapp-template-message
```php
$client = new TextClient('your-api-key');
$message = new Message('Message Text', 'Sender_name', ['Recipient_PhoneNumber']);
$message
    ->WithChannels([Channels::WHATSAPP])
    ->WithTemplate(
            new TemplateMessage(
                new WhatsappTemplate(
                    'namespace',
                    'elementname',
                    new Language('en'),
                    [
                        new ComponentBody([
                            new ComponentParameterText('firstname')
                        ])
                    ]
                )
            )
    );
$result = $client->send( [$message] );
```

## Sending a rich WhatsApp template message
It is also possible to send a rich template with an image!			

```php
$client = new TextClient('your-api-key');
$message = new Message('Message Text', 'Sender_name', ['Recipient_PhoneNumber']);
$message
    ->WithChannels([Channels::WHATSAPP])
    ->WithTemplate(
        new TemplateMessage(
            new WhatsappTemplate(
                'template-name',
                'the-namespace-of-template',
                new Language('en'),
                [
                    new ComponentHeader([
                        new ComponentParameterImage(
                            new MediaContent(
                                'image name',
                                'https://image.location',
                                'image/png'
                            )
                        )
                    ]),
                    new ComponentBody([
                        new ComponentParameterText('firstname')
                    ])
                ]
            )
        )
    );
$result = $client->send( [$message] );
```

## Sending an Apple Pay Request
It is now possible to send an apple pay request only possible in Apple Business Chat

```php
$client = new TextClient('your-api-key');
$message = new Message('Message Text', 'Sender_name', ['Recipient_PhoneNumber']);
$message
    ->WithChannels([Channels::IMESSAGE])
    ->WithPayment(
        new PaymentMessage(
            new ApplePayConfiguration(
                'merchant-name',
                'product-description',
                'unique-order-guid',
                1,
                'currency-code',
                'recipient-email',
                'recipient-country-code',
                'language-country-code',
                true,
                true,
                [
                    new LineItem(
                        'product-name',
                        'final-or-pending',
                        1
                    )
                ]
            )
        )
    );
$result = $client->send( [$message] );
```

## Sending WhatsApp interactive messages
It is now possible to send list messages and reply buttons without using templates
only supported in WhatsApp

```php
$client = new TextClient('your-api-key');
$message = new Message('Message Text', 'Sender_name', ['Recipient_PhoneNumber']);
$message
    ->WithChannels([Channels::WHATSAPP])
    ->WithRichMessage(
        new WhatsAppInteractiveMessage(
            new WhatsAppInteractiveContent(
                WhatsAppInteractiveContentTypes::LIST,
                new WhatsAppInteractiveHeader(
                    WhatsAppInteractiveHeaderTypes::TEXT,
                    'List message example'
                ),
                new WhatsAppInteractiveBody('checkout our list message demo'),
                new WhatsAppInteractiveListAction(
                    'Descriptive list title',
                    [new WhatsAppInteractiveSection(
                        'Select an option',
                        [new WhatsAppInteractiveSectionRow(
                            'unique title 1',
                            rand(),
                            'description text'
                        ),new WhatsAppInteractiveSectionRow(
                            'unique title 2',
                            rand()
                        )]
                    )]
                ),
                new WhatsAppInteractiveFooter('footer text')
            )
        )
    );
$result = $client->send( [$message] );
```

Only with Reply buttons you can send media like image,video or document
see following example.

```php
$client = new TextClient('your-api-key');
$message = new Message('Message Text', 'Sender_name', ['Recipient_PhoneNumber']);
$message
    ->WithChannels([Channels::WHATSAPP])
    ->WithRichMessage(
        new WhatsAppInteractiveMessage(
            new WhatsAppInteractiveContent(
                WhatsAppInteractiveContentTypes::BUTTON,
                new WhatsAppInteractiveHeader(
                    WhatsAppInteractiveHeaderTypes::IMAGE,
                    null,
                    new MediaContent(
                        'media name',
                        'media.url',
                        'mime/type'
                    )
                ),
                new WhatsAppInteractiveBody('checkout our list message demo'),
                new WhatsAppInteractiveButtonAction(
                    [new WhatsAppInteractiveReplyButton(
                        'button 1 reply-text',
                        rand()
                    ),new WhatsAppInteractiveReplyButton(
                        'button 2 title',
                        rand()
                    )]
                ),
                new WhatsAppInteractiveFooter('footer text')
            )
        )
    );
$result = $client->send( [$message] );
```
