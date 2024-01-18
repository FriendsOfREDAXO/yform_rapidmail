<?php

namespace Rapidmail\ApiClientTests\Api\Service\V1;

use Rapidmail\ApiClient\Service\V1\Api\Mailings\MailingStatsAnonymize\MailingStatsAnonymizeService;
use Rapidmail\ApiClientTests\Api\ApiServiceTestCase;

class MailingStatsAnonymizeServiceServiceTest extends ApiServiceTestCase
{

    /**
     * @return MailingStatsAnonymizeService
     */
    protected function newService()
    {
        return new MailingStatsAnonymizeService(
            $this->client,
            $this->responseFactory
        );
    }

    public function testAnonymize()
    {
        $this->newService()->anonymize(123);
        $this->assertHttpMethod('PUT');
        $this->assertEndpointUri('mailings/123/stats/anonymize');
    }

}