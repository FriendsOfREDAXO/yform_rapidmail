# ![rapidmail Logo](https://avatars0.githubusercontent.com/u/25850436?v=3&s=50 "rapidmail Logo") rapidmail APIv3 client

## Recipientlists Service

API Service to manage recipientlists

### Retrieve a service instance
```php
$service = $client->recipientlists();
```

###  Available methods
#### Get details for a specific recipientlist
```php
$response = $service->get(/* RECIPIENTLIST ID */);
```
#### Delete recipientlist specified by ID
```php
$response = $service->delete(/* RECIPIENTLIST ID */);
```
#### Get a list of recipientlists from current account
See [GET call documentation](https://developer.rapidmail.wiki/documentation.html?urls.primaryName=Recipientlists#/Recipientlists/get_recipientlists) on how to setup OPTIONAL FILTER
```php
$collection = $service->query(/* OPTIONAL FILTER */);
```
#### Create a new recipientlist
See [POST call documentation](https://developer.rapidmail.wiki/documentation.html?urls.primaryName=Recipientlists#/Recipientlists/post_recipientlists) on how to setup PAYLOAD
```php
$response = $service->create(/* PAYLOAD */);
```
#### Update a specific recipientlist allowing partial updates
See [PATCH call documentation](https://developer.rapidmail.wiki/documentation.html?urls.primaryName=Recipientlists#/Recipientlists/patch_recipientlists__recipientlist_id_) on how to setup PAYLOAD
```php
$response = $service->update(/* RECIPIENTLIST ID */, /* PAYLOAD */);
```
#### Get activity stats for a specific recipientlist
See [GET call documentation](https://developer.rapidmail.wiki/documentation.html?urls.primaryName=Recipientlists#/Recipientlists/get_recipientlists__recipientlist_id__stats_activity) on how to setup REQUIRED FILTER
```php
$response = $service->activityStats(/* RECIPIENTLIST ID */, /* REQUIRED FILTER */);
```