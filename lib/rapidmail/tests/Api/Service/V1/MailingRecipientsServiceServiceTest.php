<?php

namespace Rapidmail\ApiClientTests\Api\Service\V1;

use Rapidmail\ApiClient\Service\V1\Api\Mailings\MailingRecipients\MailingRecipientsService;
use Rapidmail\ApiClientTests\Api\ApiServiceTestCase;

class MailingRecipientsServiceServiceTest extends ApiServiceTestCase
{

    /**
     * @return MailingRecipientsService
     */
    protected function newService()
    {
        return new MailingRecipientsService(
            $this->client,
            $this->responseFactory
        );
    }

    public function testQuery()
    {
        $this->newService()->query(123);
        $this->assertHttpMethod('GET');
        $this->assertEndpointUri('mailings/123/stats/activity');
        $this->assertResourceKey('mailingrecipients');
    }

    public function testGet()
    {
        $this->newService()->get(123, 456);
        $this->assertHttpMethod('GET');
        $this->assertEndpointUri('mailings/123/stats/activity/456');
    }

}
