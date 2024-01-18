<?php

namespace Rapidmail\ApiClientTests\Api\Service\V1;

use Rapidmail\ApiClient\Service\V1\Api\Mailings\MailingStats\MailingStatsService;
use Rapidmail\ApiClientTests\Api\ApiServiceTestCase;

class MailingStatsServiceServiceTest extends ApiServiceTestCase
{

    /**
     * @return MailingStatsService
     */
    protected function newService()
    {
        return new MailingStatsService(
            $this->client,
            $this->responseFactory
        );
    }

    public function testGet()
    {
        $this->newService()->get(123);
        $this->assertHttpMethod('GET');
        $this->assertEndpointUri('mailings/123/stats');
    }

}