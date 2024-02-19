<?php

namespace Rapidmail\ApiClient\Service;

use Psr\Http\Message\ResponseInterface;
use Rapidmail\ApiClient\Exception\ApiException;
use Rapidmail\ApiClient\Http\HttpClientInterface;
use Rapidmail\ApiClient\Service\Response\ResponseFactory;

/**
 * Abstract Service definition
 */
abstract class AbstractService implements ServiceInterface
{

    /**
     * @var HttpClientInterface
     */
    protected $client;

    /**
     * @var ResponseFactory
     */
    protected $responseFactory;

    /**
     * Returns the resources URI path
     *
     * @return string
     */
    abstract protected function getResourcePath();

    /**
     * Constructor
     *
     * @param HttpClientInterface $client
     * @param ResponseFactory $responseFactory
     */
    public function __construct(HttpClientInterface $client, ResponseFactory $responseFactory)
    {
        $this->client = $client;
        $this->responseFactory = $responseFactory;
    }

    /**
     * Retrieve a single resource
     *
     * @param int $id
     * @return ResponseInterface
     *
     * @throws ApiException
     */
    protected function _get($id)
    {
        return $this->client->request('GET', "{$this->getResourcePath()}/{$id}");
    }

    /**
     * Query for a collection of resources
     *
     * @param array $filter
     * @return ResponseInterface
     *
     * @throws ApiException
     */
    protected function _query(array $filter = [])
    {
        return $this->client->request('GET', $this->getResourcePath(), ['query' => $filter]);
    }

    /**
     * Delete a resource
     *
     * @param int $id
     * @return ResponseInterface
     *
     * @throws ApiException
     */
    protected function _delete($id)
    {
        return $this->client->request('DELETE', "{$this->getResourcePath()}/{$id}");
    }

}
