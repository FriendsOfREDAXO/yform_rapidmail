<?php

namespace Rapidmail\ApiClient\Service\V1\Api\Mailings\MailingRecipients;

use Rapidmail\ApiClient\Exception\ApiException;
use Rapidmail\ApiClient\Service\AbstractService;
use Rapidmail\ApiClient\Service\Response\HalResponse;
use Rapidmail\ApiClient\Service\Response\HalResponseResourceIterator;

/**
 * API service to get recipient details for specific mailing
 */
class MailingRecipientsService extends AbstractService
{

    /**
     * @inheritDoc
     */
    protected function getResourcePath()
    {
        return 'mailings';
    }

    /**
     * Get details about specific mailing recipient
     *
     * @param int $mailingId
     * @param int $mailingRecipientId
     * @return HalResponse
     * @throws ApiException
     */
    public function get($mailingId, $mailingRecipientId)
    {

        $response =
            $this->client->request(
                'GET',
                "{$this->getResourcePath()}/{$mailingId}/stats/activity/{$mailingRecipientId}"
            );

        return $this->responseFactory->newHalResponse($this->client, $response);

    }

    /**
     * Get recipients for mailing
     *
     * @param int $mailingId
     * @return HalResponseResourceIterator
     * @throws ApiException
     */
    public function query($mailingId)
    {

        $response =
            $this->client->request(
                'GET',
                "{$this->getResourcePath()}/{$mailingId}/stats/activity"
            );

        return $this
            ->responseFactory
            ->newHalResponseResourceIterator(
                $this->client,
                'mailingrecipients',
                $response
            );

    }

}
