<?php

namespace Rapidmail\ApiClient\Http;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use Rapidmail\ApiClient\Exception\ApiException;

class HttpClientFacade implements HttpClientInterface
{

    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * Constructor
     *
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @inheritDoc
     */
    public function request($method, $uri, array $options = [])
    {

        try {
            return $this->client->request($method, $uri, $options);
        } catch (GuzzleException $e) {
            throw ApiException::fromGuzzleException($e);
        }

    }

}