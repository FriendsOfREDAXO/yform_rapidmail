# ![rapidmail Logo](https://avatars0.githubusercontent.com/u/25850436?v=3&s=50 "rapidmail Logo") rapidmail APIv3 client

## Typed parameters

Typed parameters are an alternative way of passing in parameters into service methods instead of using the array notation.
 
Therefore most of the services provide a `params()` method that will return a factory to build parameters. That way you can make use of the auto completion features within your IDE and easily access documentation of the available attributes. 

## Example

```php
// Typed parameter notation 

$response = $service->query(
    $service
        ->params()
        ->newQueryParam()
        ->setSortOrder('desc')
        // Use setAttribute($attrName, $attrValue) for arbitrary undocumented values
        ->setAttribute('sort_by' 'updated')
);

// The same result achieved using array notation

$response = $service->query([
    'sort_order' => 'desc',
    'sort_by' => 'updated'
]);
````