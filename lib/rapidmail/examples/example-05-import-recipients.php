<?php

use Rapidmail\ApiClient\Exception\ApiClientException;

require_once 'example-01-client-initialization.php';

// Create a recipient service instance

$recipientService = $client->recipients();

// Create a job service instance to poll for job status later on

$jobService = $client->jobs();

// Set up recipient data to be imported

$payload = [
    'file' => __DIR__ . '/example-05-import-recipient-data.csv', // Let this point to your own recipients data file
    'recipientlist_id' => 9876543210 // Enter your own recipientlist id
];

try {

    // Recipient import is an asynchronous operation. Poll the resulting job info until the job finished

    $jobInfo = $recipientService->import($payload);

    $retries = 12;

    do {

        echo "Sleeping 5 seconds before asking job (id {$jobInfo['id']}) having status '{$jobInfo['status']}' to complete" . PHP_EOL;

        sleep(5);

        $jobInfo = $jobService->get($jobInfo['id']);

        if (!in_array($jobInfo['status'], ['new', 'running'])) {
            break;
        }

    } while (--$retries > 0);

    echo "Import job completed having status '{$jobInfo['status']}'" . PHP_EOL;

} catch (ApiClientException $e) {

    // @TODO: Implement your own error handling

    if ($e->getCode() == 401) {
        die('Unauthorized access. Check if username and password are correct');
    }

    die('An API exception occurred: ' . $e->getMessage());

}
