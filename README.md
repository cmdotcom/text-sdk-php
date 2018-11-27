[![Build Status](https://travis-ci.com/cmdotcom/text-sdk-php.svg?branch=master)](https://travis-ci.com/cmdotcom/text-sdk-php)
[![codecov](https://codecov.io/gh/cmdotcom/text-sdk-php/branch/master/graph/badge.svg)](https://codecov.io/gh/cmdotcom/text-sdk-php)

# CM Text SDK
A software development kit to provide ways to interact with CM.com's Text service. API used:
- [Business Messaging](https://docs.cmtelecom.com/business-messaging/v1.0)


### Requirements

- php 7.*


## Usage

### Instantiate the client
Using your unique `ApiKey` (or product token) which authorizes you on the CM platform. Always keep this key secret!

```cs
$client = new TextClient('your-api-key'));
```

### Send a message
By calling `SendMessage` and providing message text, sender name, recipient phone number(s) and a reference (optional).

```cs
$result = $client->SendMessage('Message_Text', 'CM.com', [ 'Recipient_PhoneNumber' ], 'Your_Reference');
```

### Get the result
`SendMessage` returns an object of type `TextClientResult`, example:

```cs
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