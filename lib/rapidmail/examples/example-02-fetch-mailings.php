<?php

use Rapidmail\ApiClient\Exception\ApiClientException;

require_once 'example-01-client-initialization.php';

// Create a mailing service instance

$mailingService = $client->mailings();

// Configure an optional filter for those mailings with status "sent"

$filter = [
    'status' => 'sent'
];

// Iterate all mailings with status filter applied

try {

    foreach ($mailingService->query($filter) as $mailing) {
        echo "Mailing '{$mailing['subject']}' (id {$mailing['id']}) sent at {$mailing['sent']}" . PHP_EOL;
    }

} catch (ApiClientException $e) {

    // @TODO: Implement your own error handling

    if ($e->getCode() == 401) {
        die('Unauthorized access. Check if username and password are correct');
    }

    die('An API exception occurred: ' . $e->getMessage());

}
