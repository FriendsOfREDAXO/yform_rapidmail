# ![rapidmail Logo](https://avatars0.githubusercontent.com/u/25850436?v=3&s=50 "rapidmail Logo") rapidmail APIv3 client

## Recipients Service

API Service to manage recipients

### Examples

* [Fetch recipients](/examples/example-03-fetch-recipients.php)
* [Create recipient](/examples/example-04-create-recipient.php)
* [Import recipient data](/examples/example-05-import-recipients.php)

### Retrieve a service instance
```php
$service = $client->recipients();
```

###  Available methods
#### Load a single recipient by ID
```php
$response = $service->get(/* RECIPIENT ID */);
```
#### Delete recipient by ID
See [DELETE call documentation](https://developer.rapidmail.wiki/documentation.html?urls.primaryName=Recipients#/Recipients/delete_recipients__recipient_id_) on how to setup OPTIONAL MODIFIER
```php
$response = $service->delete(/* RECIPIENT ID */, /* OPTIONAL MODIFIER */);
```
#### List all recipients
See [GET call documentation](https://developer.rapidmail.wiki/documentation.html?urls.primaryName=Recipients#/Recipients/get_recipients) on how to setup REQUIRED FILTER
```php
$collection = $service->query(/* REQUIRED FILTER */);
```
#### Create a new recipient
See [POST call documentation](https://developer.rapidmail.wiki/documentation.html?urls.primaryName=Recipients#/Recipients/post_recipients) on how to setup PAYLOAD and OPTIONAL MODIFIER
```php
$response = $service->create(/* PAYLOAD */, /* OPTIONAL MODIFIER */);
```
* PAYLOAD: Represents the dataset you're creating
* OPTIONAL MODIFIER: Configures system behavior, like sending activationmails
#### Update a specific recipient allowing partial updates
See [PATCH call documentation](https://developer.rapidmail.wiki/documentation.html?urls.primaryName=Recipients#/Recipients/patch_recipients__recipient_id_) on how to setup PAYLOAD
```php
$response = $service->update(/* RECIPIENT ID */, /* PAYLOAD */);
```
#### Import a list of recipients into a recipientlist from a CSV file
See [POST call documentation](https://developer.rapidmail.wiki/documentation.html?urls.primaryName=Recipients#/RecipientImport/post_recipients_import) on how to setup PAYLOAD and OPTIONAL MODIFIER
```php
$response = $service->import(/* PAYLOAD */, /* OPTIONAL MODIFIER */);
```
* PAYLOAD: Expects recipientlist_id and a file to be set
* OPTIONAL MODIFIER: Configures system behavior, like setting import enclosure and delimiter