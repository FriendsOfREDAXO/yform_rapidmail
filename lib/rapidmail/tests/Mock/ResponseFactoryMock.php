<?php

namespace Rapidmail\ApiClientTests\Mock;

use Psr\Http\Message\ResponseInterface;
use Rapidmail\ApiClient\Http\HttpClientInterface;
use Rapidmail\ApiClient\Service\Response\HalResponse;
use Rapidmail\ApiClient\Service\Response\HalResponseResourceIterator;
use Rapidmail\ApiClient\Service\Response\ResponseFactory;

class ResponseFactoryMock extends ResponseFactory
{

    /**
     * @var string|null
     */
    private $lastResourceKey;

    /**
     * @var HalResponse|null
     */
    private $expectedHalResponse;

    /**
     * @var HalResponseResourceIterator|null
     */
    private $expectedHalResourceIterator;

    /**
     * @param HalResponse $expectedHalResponse
     * @return ResponseFactoryMock
     */
    public function setExpectedHalResponse(HalResponse $expectedHalResponse)
    {
        $this->expectedHalResponse = $expectedHalResponse;

        return $this;
    }

    /**
     * @param HalResponseResourceIterator $expectedHalResourceIterator
     * @return ResponseFactoryMock
     */
    public function setExpectedHalResourceIterator(HalResponseResourceIterator $expectedHalResourceIterator)
    {
        $this->expectedHalResourceIterator = $expectedHalResourceIterator;

        return $this;
    }

    /**
     * Returns the LastResourceKey
     *
     * @return string|null
     */
    public function getLastResourceKey()
    {
        return $this->lastResourceKey;
    }

    /**
     * @inheritDoc
     */
    public function newHalResponse(HttpClientInterface $client, ResponseInterface $response)
    {
        return $this->expectedHalResponse;
    }

    /**
     * @inheritDoc
     */
    public function newHalResponseResourceIterator(
        HttpClientInterface $client,
        $resourceKey,
        ResponseInterface $response
    ) {
        $this->lastResourceKey = $resourceKey;
        return $this->expectedHalResourceIterator;
    }

}