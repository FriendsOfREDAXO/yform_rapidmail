<?php

namespace Rapidmail\ApiClientTests\Api\Service\V1;

use Rapidmail\ApiClient\Service\V1\Api\Jobs\Job\JobService;
use Rapidmail\ApiClientTests\Api\ApiServiceTestCase;

class JobServiceServiceTest extends ApiServiceTestCase
{

    /**
     * @return JobService
     */
    protected function newService()
    {
        return new JobService(
            $this->client,
            $this->responseFactory
        );
    }

    public function testGet()
    {
        $this->newService()->get(123);
        $this->assertHttpMethod('GET');
        $this->assertEndpointUri('jobs/123');
    }

}