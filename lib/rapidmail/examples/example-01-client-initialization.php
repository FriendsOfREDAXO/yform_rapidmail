<?php

use Rapidmail\ApiClient\Client;
use Rapidmail\ApiClient\Exception\IncompatiblePlatformException;

// Require class autoloader

require_once '../vendor/autoload.php';

// Display all errors during development. Configure properly for production environments

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

// Authentication credentials can be found within the API section of your rapidmail account

$username = 'api_username_hash';
$password = 'api_password_hash';

// Create a new client

try {
    $client = new Client($username, $password);
} catch (IncompatiblePlatformException $e) {

    die(
        'Please configure your PHP runtime to match the libraries system requirements. '
        . $e->getMessage()
    );

}
