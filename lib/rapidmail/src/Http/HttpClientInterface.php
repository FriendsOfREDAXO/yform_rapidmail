<?php

namespace Rapidmail\ApiClient\Http;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;
use Rapidmail\ApiClient\Exception\ApiException;

interface HttpClientInterface
{

    /**
     * HTTP request wrapper
     *
     * @param string $method HTTP method.
     * @param string|UriInterface $uri URI object or string.
     * @param array $options Request options to apply.
     *
     * @return ResponseInterface
     * @throws ApiException
     */
    public function request($method, $uri, array $options = []);

}