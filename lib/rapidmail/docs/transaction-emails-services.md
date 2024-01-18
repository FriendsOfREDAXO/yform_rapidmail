# ![rapidmail Logo](https://avatars0.githubusercontent.com/u/25850436?v=3&s=50 "rapidmail Logo") rapidmail APIv3 client

## Transaction Emails Service

API service to fetch transactional emails

### Retrieve a service instance
```php
$service = $client->transactionEmails();
```

###  Available methods
#### Get list of transaction emails
See [GET call documentation](https://developer.rapidmail.wiki/documentation.html?urls.primaryName=Transaction%20Emails#/TrxEmails/get_trx_emails) on how to setup OPTIONAL FILTER
```php
$collection = $service->query(/* OPTIONAL FILTER */);
```
#### Get info about a single transaction email
```php
$response = $service->get(/* MAILHASH */);
```