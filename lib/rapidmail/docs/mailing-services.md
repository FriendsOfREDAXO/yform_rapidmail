# ![rapidmail Logo](https://avatars0.githubusercontent.com/u/25850436?v=3&s=50 "rapidmail Logo") rapidmail APIv3 client

## Mailing Service

The API service to manage mailings.

### Examples

* [Fetch mailings](/examples/example-02-fetch-mailings.php)

### Retrieve a service instance
```php
$service = $client->mailings();
```
###  Available methods
#### Get detailed info about single mailing 
```php
$response = $service->get(/* MAILING ID */);
```
#### Delete a single mailing
```php
$response = $service->delete(/* MAILING ID */);
```
#### List available mailings with optional filter criteria applied
See [GET call documentation](https://developer.rapidmail.wiki/documentation.html?urls.primaryName=Mailings#/Mailings/get_mailings) on how to setup OPTIONAL FILTER
```php
$collection = $service->query(/* OPTIONAL FILTER */);
```
#### Create a new mailing using zip file content
See [POST call documentation](https://developer.rapidmail.wiki/documentation.html?urls.primaryName=Mailings#/Mailings/post_mailings) on how to setup PAYLOAD
```php
$response = $service->create(/* PAYLOAD */);
```
#### Pause a mailing
```php
$response = $service->pause(/* MAILING ID */);
```

#### Cancel a mailing
```php
$response = $service->cancel(/* MAILING ID */);
```

## MailingRecipients Service

API service to get recipient details for specific mailing

```php
$service = $client->mailingRecipients();
```

### Available methods
#### Get recipients for mailing
```php
$collection = $service->query(/* MAILING ID */);
```
#### Get details about specific mailing recipient
```php
$response = $service->get(/* MAILING ID */, /* MAILING RECIPIENT ID */);
```

## MailingStats Service

API Service to get stats for a mailing

```php
$service = $client->mailingStats();
```

###  Available methods
#### Get stats for specific mailing
```php
$response = $service->get(/* MAILING ID */);
```

## MailingStatsAnonymize Service

API service to anonymize stats for a sent mailing

```php
$service = $client->mailingStatsAnonymize();
```

###  Available methods

#### Anonymize mailing stats for a specific sent mailing
```php
$response = $service->anonymize(/* MAILING ID */);
```
