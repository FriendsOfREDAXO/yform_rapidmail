# ![rapidmail Logo](https://avatars0.githubusercontent.com/u/25850436?v=3&s=50 "rapidmail Logo") rapidmail APIv3 client

## Blacklist Service

API service to manage blacklist entries

### Examples

* [Import blacklist data](/examples/example-06-import-blacklist.php)

### Retrieve a service instance
```php
$service = $client->blacklist();
```

###  Available methods

#### Get info about a single blacklist entry
```php
$response = $service->get(/* BLACKLIST ID */);
```
#### Delete blacklist entry by ID
```php
$response = $service->delete(/* BLACKLIST ID */);
```
#### Get list of blacklist entries
See [GET call documentation](https://developer.rapidmail.wiki/documentation.html?urls.primaryName=Blacklist#/Blacklist/get_blacklist) on how to setup OPTIONAL FILTER
```php
$collection = $service->query(/* OPTIONAL FILTER */);
```
#### Create a new blacklist entry
See [POST call documentation](https://developer.rapidmail.wiki/documentation.html?urls.primaryName=Blacklist#/Blacklist/post_blacklist) on how to setup PAYLOAD
```php
$response = $service->create(/* PAYLOAD */);
```
#### Import blacklist from CSV file
```php
$response = $service->import(/* FILE */);
```