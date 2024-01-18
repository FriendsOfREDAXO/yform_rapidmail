<?php

namespace Rapidmail\ApiClientTests\Api\Http;

use GuzzleHttp\Client;
use Rapidmail\ApiClient\Http\HttpClientFacade;
use Rapidmail\ApiClient\Http\HttpClientFactory;
use Rapidmail\ApiClient\Http\HttpClientInterface;
use Yoast\PHPUnitPolyfills\TestCases\TestCase;

class HttpClientFactoryTest extends TestCase
{

    public function testCreateClient()
    {

        $factory = new HttpClientFactory();
        $client = $factory->createClient([
            'throttle_interval' => 1,
            'throttle_requests_per_interval' => 1,
            'base_uri' => 'https://www.example.net',
            'version' => 'version'
        ]);

        $this->assertInstanceOf(HttpClientInterface::class, $client);

        $class = new \ReflectionClass(HttpClientFacade::class);
        $property = $class->getProperty('client');
        $property->setAccessible(true);

        /** @var Client $internalClient */
        $internalClient = $property->getValue($client);
        $headers = $internalClient->getConfig('headers');

        $this->assertEquals('https://www.example.net/version/', (string)$internalClient->getConfig('base_uri'));
        $this->assertEquals('application/json', $headers['Accept']);
        $this->assertMatchesRegularExpression('~rapidmail-apiv3-client-php/\d+\.\d+\.\d+ \([^\)]*\)~', $headers['User-Agent']);

    }

}
