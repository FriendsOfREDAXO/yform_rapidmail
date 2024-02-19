<?php

namespace Rapidmail\ApiClient\Service\Response;

use Psr\Http\Message\ResponseInterface as HttpResponseInterface;
use Rapidmail\ApiClient\Exception\ApiException;
use Rapidmail\ApiClient\Http\HttpClientInterface;

class ResponseFactory
{

    /**
     * Returns a new HalResponse instance
     *
     * @param HttpClientInterface $client
     * @param HttpResponseInterface $response
     * @return HalResponse
     * @throws ApiException
     */
    public function newHalResponse(HttpClientInterface $client, HttpResponseInterface $response)
    {
        return new HalResponse($client, $this, $this->decodeResponse($response));
    }

    /**
     * Returns a new HalResponseResourceIterator to transparently iterate all nested resources within a paged result
     *
     * @param HttpClientInterface $client
     * @param string $resourceKey
     * @param HttpResponseInterface $response
     * @return HalResponseResourceIterator
     * @throws ApiException
     */
    public function newHalResponseResourceIterator(
        HttpClientInterface $client,
        $resourceKey,
        HttpResponseInterface $response
    ) {

        return new HalResponseResourceIterator(
            new HalResponsePaginationIterator(
                $this->newHalResponse($client, $response)
            ),
            $resourceKey
        );

    }

    /**
     * @inheritDoc
     */
    protected function decodeResponse(HttpResponseInterface $response)
    {
        $decodedResponse = json_decode($response->getBody(), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new ApiException(json_last_error_msg());
        }

        if (empty($decodedResponse)) {
            $decodedResponse = [];
        }

        return $decodedResponse;

    }

}
