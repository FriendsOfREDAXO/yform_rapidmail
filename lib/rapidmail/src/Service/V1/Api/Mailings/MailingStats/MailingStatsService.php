<?php

namespace Rapidmail\ApiClient\Service\V1\Api\Mailings\MailingStats;

use Rapidmail\ApiClient\Exception\ApiException;
use Rapidmail\ApiClient\Service\AbstractService;
use Rapidmail\ApiClient\Service\Response\HalResponse;

/**
 * API Service to get stats for a mailing
 */
class MailingStatsService extends AbstractService
{

    /**
     * @inheritDoc
     */
    protected function getResourcePath()
    {
        return 'mailings';
    }

    /**
     * Get stats for specific mailing
     *
     * @param int $mailingId
     * @return HalResponse
     * @throws ApiException
     */
    public function get($mailingId)
    {

        $response = $this->client->request(
            'GET',
            "{$this->getResourcePath()}/{$mailingId}/stats"
        );

        return $this->responseFactory->newHalResponse($this->client, $response);

    }

}
