<?php

namespace Rapidmail\ApiClient\Service\V1\Api\Mailings\Mailing;

use GuzzleHttp\RequestOptions;
use Rapidmail\ApiClient\Exception\ApiException;
use Rapidmail\ApiClient\Exception\InvalidArgumentException;
use Rapidmail\ApiClient\Http\HttpClientInterface;
use Rapidmail\ApiClient\Service\AbstractService;
use Rapidmail\ApiClient\Service\Response\HalResponse;
use Rapidmail\ApiClient\Service\Response\HalResponseResourceIterator;
use Rapidmail\ApiClient\Service\Response\ResponseFactory;
use Rapidmail\ApiClient\Service\V1\Api\Mailings\Mailing\Parameter\MailingCreateParam;
use Rapidmail\ApiClient\Service\V1\Api\Mailings\Mailing\Parameter\MailingQueryParam;
use Rapidmail\ApiClient\Service\V1\Api\Mailings\Mailing\Parameter\ParameterFactory;

/**
 * API service to manage mailings
 */
class MailingService extends AbstractService
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
        parent::__construct($client, $responseFactory);
        $this->parameterFactory = $parameterFactory;
    }

    /**
     * @inheritDoc
     */
    protected function getResourcePath()
    {
        return 'mailings';
    }

    /**
     * @return ParameterFactory
     */
    public function params()
    {
        return $this->parameterFactory;
    }

    /**
     * Get detailed info about single mailing
     *
     * @param int $mailingId
     * @return HalResponse
     *
     * @throws ApiException
     */
    public function get($mailingId)
    {

        return $this->responseFactory->newHalResponse(
            $this->client,
            $this->_get($mailingId)
        );

    }

    /**
     * List all mailings
     *
     * @param MailingQueryParam|array $filter
     * @return HalResponseResourceIterator
     *
     * @throws ApiException
     */
    public function query($filter = [])
    {

        if (is_array($filter)) {
            $filter = $this->params()->newQueryParam($filter);
        }

        if (!$filter instanceof MailingQueryParam) {

            throw new InvalidArgumentException(
                'Invalid filter provided. Must be an array or MailingQueryParam'
            );

        }

        return $this->responseFactory->newHalResponseResourceIterator(
            $this->client,
            'mailings',
            $this->_query(
                $filter->toArray()
            )
        );

    }

    /**
     * Delete a single mailing
     *
     * @param int $mailingId
     * @return bool
     *
     * @throws ApiException
     */
    public function delete($mailingId)
    {
        return $this->_delete($mailingId)->getStatusCode() == 204;
    }

    /**
     * Pause a mailing
     *
     * @param int $mailingId
     * @return bool
     *
     * @throws ApiException
     */
    public function pause($mailingId)
    {
        return $this
                ->client
                ->request(
                    'POST',
                    "{$this->getResourcePath()}/{$mailingId}/pause"
                )
                ->getStatusCode() == 200;
    }

    /**
     * Cancel a mailing
     *
     * @param int $mailingId
     * @param string $reason
     * @return bool
     *
     * @throws ApiException
     */
    public function cancel($mailingId, $reason)
    {
        return $this
                ->client
                ->request(
                    'POST',
                    "{$this->getResourcePath()}/{$mailingId}/cancel",
                    [
                        RequestOptions::JSON => [
                            "reason" => $reason
                        ]
                    ]
                )
                ->getStatusCode() == 200;

    }

    /**
     * Create a new mailing using zip file content
     *
     * @param array|MailingCreateParam $data
     * @return HalResponse
     * @throws ApiException
     */
    public function create($data = [])
    {

        if (is_array($data)) {
            $data = $this->params()->newCreateParam($data);
        }

        if (!$data instanceof MailingCreateParam) {

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

}
