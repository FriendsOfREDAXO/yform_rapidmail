<?php

namespace Rapidmail\ApiClientTests\Api;

use Rapidmail\ApiClientTests\Mock\HttpClientMock;
use Rapidmail\ApiClientTests\Mock\ResponseFactoryMock;
use Yoast\PHPUnitPolyfills\TestCases\TestCase;

class ApiServiceTestCase extends TestCase
{

    /**
     * @var HttpClientMock
     */
    protected $client;

    /**
     * @var ResponseFactoryMock
     */
    protected $responseFactory;

    /**
     * Assert endpoint URI matched
     *
     * @param string $uri
     */
    public function assertEndpointUri($uri)
    {
        $this->assertEquals($uri, $this->client->getLastUri());
    }

    /**
     * Assert HTTP method matched
     *
     * @var string $method
     */
    public function assertHttpMethod($method)
    {
        $this->assertEquals($method, $this->client->getLastMethod());
    }

    public function assertResourceKey($resourceKey)
    {
        $this->assertEquals($resourceKey, $this->responseFactory->getLastResourceKey());
    }

    /**
     * @inheritDoc
     */
    protected function tear_down()
    {
        $this->client = null;
        $this->responseFactory = null;
    }

    /**
     * @inheritDoc
     */
    protected function set_up()
    {
        $this->client = new HttpClientMock();
        $this->responseFactory = new ResponseFactoryMock();
    }
}
