<?php

use Rapidmail\ApiClient\Exception\ApiClientException;

require_once 'example-01-client-initialization.php';

// Create a blacklist service instance

$blacklistService = $client->blacklist();

// Create a job service instance to poll for job status later on

$jobService = $client->jobs();

try {

    // Blacklist import is an asynchronous operation. Poll the resulting job info until the job finished

    $jobInfo = $blacklistService->import(__DIR__ . '/example-06-import-blacklist-data.csv');

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

