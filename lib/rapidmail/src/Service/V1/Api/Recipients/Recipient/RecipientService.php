<?php

namespace Rapidmail\ApiClient\Service\V1\Api\Recipients\Recipient;

use GuzzleHttp\RequestOptions;
use Rapidmail\ApiClient\Exception\ApiException;
use Rapidmail\ApiClient\Exception\InvalidArgumentException;
use Rapidmail\ApiClient\Http\HttpClientInterface;
use Rapidmail\ApiClient\Service\AbstractService;
use Rapidmail\ApiClient\Service\Response\HalResponse;
use Rapidmail\ApiClient\Service\Response\HalResponseResourceIterator;
use Rapidmail\ApiClient\Service\Response\ResponseFactory;
use Rapidmail\ApiClient\Service\V1\Api\Recipients\Recipient\Parameter\ParameterFactory;
use Rapidmail\ApiClient\Service\V1\Api\Recipients\Recipient\Parameter\RecipientCreateParam;
use Rapidmail\ApiClient\Service\V1\Api\Recipients\Recipient\Parameter\RecipientCreateQueryParam;
use Rapidmail\ApiClient\Service\V1\Api\Recipients\Recipient\Parameter\RecipientDeleteQueryParam;
use Rapidmail\ApiClient\Service\V1\Api\Recipients\Recipient\Parameter\RecipientImportParam;
use Rapidmail\ApiClient\Service\V1\Api\Recipients\Recipient\Parameter\RecipientImportQueryParam;
use Rapidmail\ApiClient\Service\V1\Api\Recipients\Recipient\Parameter\RecipientQueryParam;

/**
 * API Service to manage recipients
 */
class RecipientService extends AbstractService
{

    /**
     * @var ParameterFactory
     */
    protected $parameterFactory;

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
     * @inheritDoc
     */
    protected function getResourcePath()
    {
        return 'recipients';
    }

    /**
     * @return ParameterFactory
     */
    public function params()
    {
        return $this->parameterFactory;
    }

    /**
     * Load a single recipient by ID
     *
     * @param int $recipientId
     * @return HalResponse
     *
     * @throws ApiException
     */
    public function get($recipientId)
    {

        return $this->responseFactory->newHalResponse(
            $this->client,
            $this->_get($recipientId)
        );

    }

    /**
     * List all recipients
     *
     * @param int|array|RecipientQueryParam $filter
     * @return HalResponseResourceIterator
     *
     * @throws ApiException
     */
    public function query($filter = [])
    {

        if (is_numeric($filter)) {

            // Assume a recipient list ID was provided

            $filter = $this->parameterFactory->newQueryParam()->setRecipientlistId($filter);

        }

        if (is_array($filter)) {
            $filter = $this->params()->newQueryParam($filter);
        }

        if (!$filter instanceof RecipientQueryParam) {

            throw new InvalidArgumentException(
                'Invalid filter provided. Must be an array or RecipientQueryParam'
            );

        }

        return $this->responseFactory->newHalResponseResourceIterator(
            $this->client,
            'recipients',
            $this->_query(
                $filter->toArray()
            )
        );

    }

    /**
     * Create a new recipient
     *
     * @param array|RecipientCreateParam $data
     * @param array|RecipientCreateQueryParam $query Optional: Modify create behavior
     * @return HalResponse
     * @throws ApiException
     */
    public function create($data = [], $query = [])
    {

        $method = 'POST';
        $uri = $this->getResourcePath();

        return $this->upsert($method, $uri, $data, $query);

    }

    /**
     * Update a specific recipient allowing partial updates
     *
     * @param int $recipientId
     * @param string|array|RecipientCreateParam $data
     * @return HalResponse
     * @throws ApiException
     */
    public function update($recipientId, $data = [])
    {

        $method = 'PATCH';
        $uri = "{$this->getResourcePath()}/{$recipientId}";

        return $this->upsert($method, $uri, $data, []);

    }

    /**
     * Delete recipient by ID
     *
     * Please note that a recipient is only soft-deleted and marked as deleted
     * when calling this to mimic unsubscribe behavior.
     *
     * @param int $recipientId
     * @param array|RecipientDeleteQueryParam
     * @return bool
     * @throws ApiException
     */
    public function delete($recipientId, $query = [])
    {

        if (is_array($query)) {
            $query = $this->params()->newDeleteQueryParam($query);
        }

        if (!$query instanceof RecipientDeleteQueryParam) {

            throw new InvalidArgumentException(
                'Invalid filter provided. Must be an array or RecipientDeleteQueryParam'
            );

        }

        return $this
                ->client
                ->request(
                    'DELETE',
                    "{$this->getResourcePath()}/{$recipientId}",
                    [
                        RequestOptions::QUERY => $query->toArray()
                    ]
                )
                ->getStatusCode() == 204;

    }

    /**
     * Creates or updates a recipient
     *
     * @param string $method
     * @param string $uri
     * @param array|RecipientCreateParam $data
     * @param array|RecipientCreateQueryParam $query
     * @return HalResponse
     * @throws ApiException
     */
    private function upsert($method, $uri, $data, $query)
    {

        if (is_array($data)) {
            $data = $this->params()->newCreateParam($data);
        }

        if (!$data instanceof RecipientCreateParam) {

            throw new InvalidArgumentException(
                'Invalid filter provided. Must be an array or RecipientCreateParam'
            );

        }

        if (is_array($query)) {
            $query = $this->params()->newCreateQueryParam($query);
        }

        if (!$query instanceof RecipientCreateQueryParam) {

            throw new InvalidArgumentException(
                'Invalid filter provided. Must be an array or RecipientCreateQueryParam'
            );

        }

        $response = $this->client->request(
            $method,
            $uri,
            [
                RequestOptions::JSON => $data->toArray(),
                RequestOptions::QUERY => $query->toArray()
            ]
        );

        return $this->responseFactory->newHalResponse($this->client, $response);
    }

    /**
     * Import a list of recipients into the recipientlist from a CSV file
     *
     * Multipart uploads are not supported. Please note that the import will not be instantaneous,
     * but will be queued in the jobqueue for processing, and a job entity response returned.
     * The Jobs api service can then be used to poll the job status.
     *
     * @param array|RecipientImportParam $data
     * @param array|RecipientImportQueryParam $query
     * @return HalResponse
     * @throws ApiException
     */
    public function import($data = [], $query = [])
    {

        if (is_array($data)) {
            $data = $this->params()->newImportParam($data);
        }

        if (!$data instanceof RecipientImportParam) {

            throw new InvalidArgumentException(
                'Invalid filter provided. Must be an array or RecipientImportParam'
            );

        }

        if (is_array($query)) {
            $query = $this->params()->newImportQueryParam($query);
        }

        if (!$query instanceof RecipientImportQueryParam) {

            throw new InvalidArgumentException(
                'Invalid filter provided. Must be an array or RecipientImportQueryParam'
            );

        }

        $response = $this->client->request(
            'POST',
            "{$this->getResourcePath()}/import",
            [
                RequestOptions::JSON => $data->toArray(),
                RequestOptions::QUERY => $query->toArray()
            ]
        );

        return $this->responseFactory->newHalResponse($this->client, $response);

    }

}
