<?php

namespace Rapidmail\ApiClient\Service\V1\Api\Jobs\Job;

use Rapidmail\ApiClient\Exception\ApiException;
use Rapidmail\ApiClient\Service\AbstractService;
use Rapidmail\ApiClient\Service\Response\HalResponse;

/**
 * API service to poll information about jobs from the jobexecutor queue
 */
class JobService extends AbstractService
{

    /**
     * @inheritDoc
     */
    protected function getResourcePath()
    {
        return 'jobs';
    }

    /**
     * Get details about a specific job
     *
     * @param int $jobId
     * @return HalResponse
     * @throws ApiException
     */
    public function get($jobId)
    {

        return $this
            ->responseFactory
            ->newHalResponse(
                $this->client,
                $this->_get($jobId)
            );

    }

}
