<?php
/**
 * run Composer first to install the sdk with all it's dependencies in your project. (getcomposer.org)
 *   composer install
 */
require_once "../vendor/autoload.php";

/**
 * initiate the TextClient.
 * put in your own api-key for authentication.
 */
$client = new \CMText\TextClient('your-api-key');

/**
 * send a message and get the JSON output returned to your command line.
 */
echo json_encode(
    $client->SendMessage('Message_Text', 'CM.com', [ 'Recipient_PhoneNumber' ], 'Your_Reference')
);
