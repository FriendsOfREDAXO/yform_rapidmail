<?php

use Rapidmail\ApiClient\Exception\ApiClientException;

require_once 'example-01-client-initialization.php';

// Create a recipient service instance

$recipientService = $client->recipients();

// Set up a recipient data to be inserted. "email" and "recipientlist_id" are both required

$payload = [
    'email' => 'info@example.net', // Enter your own recipient address
    'recipientlist_id' => 9876543210 // Enter your own recipientlist id
];

// Optional modifier that changes recipient creation behavior

$modifier = [
    'send_activationmail' => 'no' // Set to 'yes' if you want to sent an activation email to your recipient, Warning: activation emails are _never_ sent for demo accounts.
];

// Create a recipient

try {

    $recipient = $recipientService->create($payload, $modifier);
    echo "Created recipient '{$recipient['email']}' (id {$recipient['id']})" . PHP_EOL;

} catch (ApiClientException $e) {

    // @TODO: Implement your own error handling

    if ($e->getCode() == 401) {
        die('Unauthorized access. Check if username and password are correct');
    }

    die('An API exception occurred: ' . $e->getMessage());

}

