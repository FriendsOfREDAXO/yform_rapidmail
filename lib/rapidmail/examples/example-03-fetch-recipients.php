<?php

use Rapidmail\ApiClient\Exception\ApiClientException;

require_once 'example-01-client-initialization.php';

// Create a recipient service instance

$recipientService = $client->recipients();

// Configure a required filter to fetch recipients for a certain recipientlist id
// Note that if no "status" filter is provided only "active" recipients will be returned

$filter = [
    'recipientlist_id' => 9876543210 // Enter your own recipientlist id
];

// Iterate all recipients with recipientlist id filter applied

try {

    foreach ($recipientService->query($filter) as $recipient) {
        echo "Recipient '{$recipient['email']}' (id {$recipient['id']}) in status '{$recipient['status']}'" . PHP_EOL;
    }

} catch (ApiClientException $e) {

    // @TODO: Implement your own error handling

    if ($e->getCode() == 401) {
        die('Unauthorized access. Check if username and password are correct');
    }

    die('An API exception occurred: ' . $e->getMessage());

}

