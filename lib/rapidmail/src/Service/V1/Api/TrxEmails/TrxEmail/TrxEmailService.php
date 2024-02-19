<?php

namespace Rapidmail\ApiClient\Service\V1\Api\TrxEmails\TrxEmail;

use Rapidmail\ApiClient\Exception\ApiException;
use Rapidmail\ApiClient\Exception\InvalidArgumentException;
use Rapidmail\ApiClient\Http\HttpClientInterface;
use Rapidmail\ApiClient\Service\AbstractService;
use Rapidmail\ApiClient\Service\Response\HalResponse;
use Rapidmail\ApiClient\Service\Response\HalResponseResourceIterator;
use Rapidmail\ApiClient\Service\Response\ResponseFactory;
use Rapidmail\ApiClient\Service\V1\Api\TrxEmails\TrxEmail\Parameter\ParameterFactory;
use Rapidmail\ApiClient\Service\V1\Api\TrxEmails\TrxEmail\Parameter\TrxEmailQueryParam;

/**
 * API service to fetch transactional emails
 */
class TrxEmailService extends AbstractService
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
        return 'trx/emails';
    }

    /**
     * Get list of transaction emails
     *
     * @param array|TrxEmailQueryParam $filter
     * @return HalResponseResourceIterator
     * @throws ApiException
     */
    public function query($filter = [])
    {

        if (is_array($filter)) {
            $filter = $this->parameterFactory->newQueryParam($filter);
        }

        if (!$filter instanceof TrxEmailQueryParam) {

            throw new InvalidArgumentException(
                'Invalid filter provided. Must be an array or TrxEmailQueryParam'
            );

        }

        return $this->responseFactory->newHalResponseResourceIterator(
            $this->client,
            'trxemails',
            $this->_query(
                $filter->toArray()
            )
        );

    }

    /**
     * Get info about a single transaction email
     *
     * @param string $hash
     * @return HalResponse
     * @throws ApiException
     */
    public function get($hash)
    {

        return $this
            ->responseFactory
            ->newHalResponse(
                $this->client,
                $this->_get($hash)
            );

    }

}
