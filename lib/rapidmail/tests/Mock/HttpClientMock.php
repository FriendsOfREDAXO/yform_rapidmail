<?php

namespace Rapidmail\ApiClientTests\Mock;

use GuzzleHttp\Psr7\Response;
use Rapidmail\ApiClient\Http\HttpClientInterface;

class HttpClientMock implements HttpClientInterface
{

    /**
     * @var Response
     */
    private $expectedResponse;

    /**
     * @var string|null
     */
    private $lastMethod;

    /**
     * @var string|null
     */
    private $lastUri;

    /**
     * @var array|null
     */
    private $lastOptions;

    /**
     * Constructor
     *
     * @param Response $expectedResponse
     */
    public function __construct(Response $expectedResponse = null)
    {

        $this->expectedResponse = empty($expectedResponse)
            ? new Response()
            : $expectedResponse;

    }

    /**
     * @inheritDoc
     */
    public function request($method, $uri, array $options = [])
    {

        $this->lastMethod = $method;
        $this->lastUri = $uri;
        $this->lastOptions = $options;

        return $this->expectedResponse;

    }

    /**
     * Sets the expected Response
     *
     * @param Response $expectedResponse
     * @return HttpClientMock
     */
    public function setExpectedResponse(Response $expectedResponse)
    {
        $this->expectedResponse = $expectedResponse;

        return $this;
    }

    /**
     * Returns the LastMethod
     *
     * @return string|null
     */
    public function getLastMethod()
    {
        return $this->lastMethod;
    }

    /**
     * Returns the LastUri
     *
     * @return string|null
     */
    public function getLastUri()
    {
        return $this->lastUri;
    }

    /**
     * Returns the LastOptions
     *
     * @return array|null
     */
    public function getLastOptions()
    {
        return $this->lastOptions;
    }

}