<?php

namespace Rapidmail\ApiClient\Service\V1\Api\Blacklist\Blacklist;

use GuzzleHttp\RequestOptions;
use Rapidmail\ApiClient\Exception\ApiException;
use Rapidmail\ApiClient\Exception\InvalidArgumentException;
use Rapidmail\ApiClient\Http\HttpClientInterface;
use Rapidmail\ApiClient\Service\AbstractService;
use Rapidmail\ApiClient\Service\Response\HalResponse;
use Rapidmail\ApiClient\Service\Response\HalResponseResourceIterator;
use Rapidmail\ApiClient\Service\Response\ResponseFactory;
use Rapidmail\ApiClient\Service\V1\Api\Blacklist\Blacklist\Parameter\BlacklistCreateParam;
use Rapidmail\ApiClient\Service\V1\Api\Blacklist\Blacklist\Parameter\BlacklistImportParam;
use Rapidmail\ApiClient\Service\V1\Api\Blacklist\Blacklist\Parameter\BlacklistQueryParam;
use Rapidmail\ApiClient\Service\V1\Api\Blacklist\Blacklist\Parameter\ParameterFactory;

/**
 * API service to manage blacklist entries
 */
class BlacklistService extends AbstractService
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
     * @inheritDoc
     */
    protected function getResourcePath()
    {
        return 'blacklist';
    }

    /**
     * @return ParameterFactory
     */
    public function params()
    {
        return $this->parameterFactory;
    }

    /**
     * Get list of blacklist entries
     *
     * @param array|BlacklistQueryParam $filter
     * @return HalResponseResourceIterator
     *
     * @throws ApiException
     */
    public function query($filter = [])
    {

        if (is_array($filter)) {
            $filter = $this->params()->newQueryParam($filter);
        }

        if (!$filter instanceof BlacklistQueryParam) {

            throw new InvalidArgumentException(
                'Invalid filter provided. Must be an array or BlacklistQueryParam'
            );

        }

        return $this->responseFactory->newHalResponseResourceIterator(
            $this->client,
            'blacklist',
            $this->_query(
                $filter->toArray()
            )
        );

    }

    /**
     * Create a new blacklist entry
     *
     * @param string|array|BlacklistCreateParam $data
     * @return HalResponse
     * @throws ApiException
     */
    public function create($data = [])
    {

        if (is_string($data)) {

            // Assume pattern was provided

            $data = $this->params()->newCreateParam()->setPattern($data);
        }

        if (is_array($data)) {
            $data = $this->params()->newCreateParam($data);
        }

        if (!$data instanceof BlacklistCreateParam) {

            throw new InvalidArgumentException(
                'Invalid filter provided. Must be an array or MailingCreateParam'
            );

        }

        $response =
            $this->client->request(
                'POST',
                $this->getResourcePath(),
                [
                    RequestOptions::JSON => $data->toArray()
                ]
            );

        return $this->responseFactory->newHalResponse($this->client, $response);

    }

    /**
     * Get info about a single blacklist entry
     *
     * @param int $blacklistId
     * @return HalResponse
     *
     * @throws ApiException
     */
    public function get($blacklistId)
    {

        return $this->responseFactory->newHalResponse(
            $this->client,
            $this->_get($blacklistId)
        );

    }

    /**
     * Delete blacklist entry by ID
     *
     * @param int $blacklistId
     * @return bool
     * @throws ApiException
     */
    public function delete($blacklistId)
    {
        return $this->_delete($blacklistId)->getStatusCode() == 204;
    }

    /**
     * Import blacklist from CSV file
     *
     * The CSV file needs to contain the blacklist patterns in the first column only.
     * Additional fields cannot be imported. A header line is not supported.
     *
     * @param string|\SplFileInfo|array|BlacklistImportParam $data
     * @return HalResponse
     * @throws ApiException
     */
    public function import($data = [])
    {

        if (is_string($data) || $data instanceof \SplFileInfo) {

            // Assume a file is provided

            $data = $this->params()->newImportParam()->setFile($data);

        }

        if (is_array($data)) {
            $data = $this->params()->newImportParam($data);
        }

        if (!$data instanceof BlacklistImportParam) {

            throw new InvalidArgumentException(
                'Invalid filter provided. Must be an array or BlacklistImportParam'
            );

        }

        $response =
            $this->client->request(
                'POST',
                "{$this->getResourcePath()}/import",
                [
                    RequestOptions::JSON => $data->toArray()
                ]
            );

        return $this->responseFactory->newHalResponse($this->client, $response);

    }

}
