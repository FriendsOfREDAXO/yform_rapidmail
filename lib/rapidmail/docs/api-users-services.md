# ![rapidmail Logo](https://avatars0.githubusercontent.com/u/25850436?v=3&s=50 "rapidmail Logo") rapidmail APIv3 client

##  Service

API Service to manage API users

### Retrieve a service instance
```php
$service = $client->apiUsers();
```

###  Available methods

#### Get details about an API user
```php
$response = $service->get(/* API USER ID */);
```
#### Delete a single API user
```php
$collection = $service->delete(/* API USER ID */);
```
#### Get a list of API users
```php
$collection = $service->query();
```
#### Create a new API user
See [POST call documentation](https://developer.rapidmail.wiki/documentation.html#/ApiUsers/post_apiusers) on how to setup PAYLOAD 
```php
$response = $service->create(/* PAYLOAD */);
```
#### Partially update an API user
See [PATCH call documentation](https://developer.rapidmail.wiki/documentation.html#/ApiUsers/patch_apiusers__apiuser_id_) on how to setup PAYLOAD 
```php
$response = $service->update(/* API USER ID */, /* PAYLOAD */);
```