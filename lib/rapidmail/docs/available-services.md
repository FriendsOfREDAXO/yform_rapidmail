# ![rapidmail Logo](https://avatars0.githubusercontent.com/u/25850436?v=3&s=50 "rapidmail Logo") rapidmail APIv3 client

The API client was designed to access all rapidmail APIs in a simple and homogenous way. Each service can be accessed with only a few lines of code. Here you will find information about how to access the various APIs and services. 

## Available Services 

 Follow the links to receive an in-depth documentation about the available services and their callable methods:

* [API users](/docs/api-users-services.md) 
* [Blacklist](/docs/blacklist-services.md)
* [Jobs](/docs/jobs-services.md)
* [Mailings](/docs/mailing-services.md)
* [Recipient lists](/docs/recipientlists-services.md)
* [Recipients](/docs/recipients-services.md)
* [Transaction emails](/docs/transaction-emails-services.md)

## Request design

We target for a concise and consistent wording within service methods which is described as follows:

* get($id) Will receive a single entity by a given ID
* delete($id) Will delete single entity by a given ID
* query($filter = []) Will receive a collection (optionally filtered)
* create($payload = []) Will create a single entity
* update($id, $payload = []) Will update a single entity by a given ID

Refer to the section above to to see which methods exist within a service context.
