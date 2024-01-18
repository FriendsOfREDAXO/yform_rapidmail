<?php

namespace Rapidmail\ApiClient\Service\V1\Api\ApiUsers\ApiUser;

use GuzzleHttp\RequestOptions;
use Rapidmail\ApiClient\Exception\ApiException;
use Rapidmail\ApiClient\Exception\InvalidArgumentException;
use Rapidmail\ApiClient\Http\HttpClientInterface;
use Rapidmail\ApiClient\Service\AbstractService;
use Rapidmail\ApiClient\Service\Response\HalResponse;
use Rapidmail\ApiClient\Service\Response\HalResponseResourceIterator;
use Rapidmail\ApiClient\Service\Response\ResponseFactory;
use Rapidmail\ApiClient\Service\V1\Api\ApiUsers\ApiUser\Parameter\ApiUserCreateParam;
use Rapidmail\ApiClient\Service\V1\Api\ApiUsers\ApiUser\Parameter\ApiUserQueryParam;
use Rapidmail\ApiClient\Service\V1\Api\ApiUsers\ApiUser\Parameter\ParameterFactory;

/**
 * API Service to manage API users
 */
class ApiUserService extends AbstractService
{

    /**
     * @var ParameterFactory
     */
    private $parameterFactory;

    /**
     * Constructor
     *
     * @param HttpClientInterface $client
     * @param ResponseFactory $responseFactory
     * @param ParameterFactory $parameterFactory
     */
    public function __construct(
        HttpClientInterface $client,
        ResponseFactory $responseFactory,
        ParameterFactory $parameterFactory
    ) {
        $this->parameterFactory = $parameterFactory;
        parent::__construct($client, $responseFactory);
    }

    /**
     * @return ParameterFactory
     */
    public function params()
    {
        return $this->parameterFactory;
    }

    /**
     * @inheritDoc
     */
    protected function getResourcePath()
    {
        return 'apiusers';
    }

    /**
     * Get a list of API users
     *
     * @param array|ApiUserQueryParam $filter
     * @return HalResponseResourceIterator
     * @throws ApiException
     */
    public function query($filter = [])
    {

        if (is_array($filter)) {
            $filter = $this->params()->newQueryParam($filter);
        }

        if (!$filter instanceof ApiUserQueryParam) {
            throw new InvalidArgumentException('Invalid filter provided. Must be an array or ApiUserQueryParam');
        }

        return $this->responseFactory->newHalResponseResourceIterator(
            $this->client,
            'apiusers',
            $this->_query(
                $filter->toArray()
            )
        );

    }

    /**
     * Get details about an API user
     *
     * @param string
     * @return HalResponse
     * @throws ApiException
     */
    public function get($apiUserId)
    {

        return $this->responseFactory->newHalResponse(
            $this->client,
            $this->_get($apiUserId)
        );

    }

    /**
     * Delete a single API user
     *
     * @param int $apiUserId
     * @return bool
     *
     * @throws ApiException
     */
    public function delete($apiUserId)
    {
        return $this->_delete($apiUserId)->getStatusCode() == 204;
    }

    /**
     * Creates or updates an API user
     *
     * @param string $method
     * @param string $uri
     * @param array|ApiUserCreateParam $data
     * @return HalResponse
     * @throws ApiException
     */
    private function upsert($method, $uri, $data)
    {

        if (is_array($data)) {
            $data = $this->params()->newCreateParam($data);
        }

        if (!$data instanceof ApiUserCreateParam) {

            throw new InvalidArgumentException(
                'Invalid filter provided. Must be an array or ApiUserCreateParam'
            );

        }

        $response = $this->client->request(
            $method,
            $uri,
            [
                RequestOptions::JSON => $data->toArray(),
            ]

        );

        return $this->responseFactory->newHalResponse($this->client, $response);
    }

    /**
     * Create a new API user
     *
     * Username and password will be created automatically.
     *
     * @param array|ApiUserCreateParam $data
     * @return HalResponse
     * @throws ApiException
     */
    public function create($data = [])
    {

        return $this->upsert(
            'POST',
            $this->getResourcePath(),
            $data
        );

    }

    /**
     * Partially update an API user
     *
     * @param int $apiUserId
     * @param array|ApiUserCreateParam $data
     * @return HalResponse
     * @throws ApiException
     */
    public function update($apiUserId, $data = [])
    {

        return $this->upsert(
            'PATCH',
            "{$this->getResourcePath()}/{$apiUserId}",
            $data
        );

    }

}