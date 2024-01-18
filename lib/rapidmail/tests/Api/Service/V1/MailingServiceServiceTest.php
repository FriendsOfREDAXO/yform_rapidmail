<?php

namespace Rapidmail\ApiClientTests\Api\Service\V1;

use GuzzleHttp\Psr7\Response;
use Rapidmail\ApiClient\Service\V1\Api\Mailings\Mailing\MailingService;
use Rapidmail\ApiClient\Service\V1\Api\Mailings\Mailing\Parameter\ParameterFactory;
use Rapidmail\ApiClientTests\Api\ApiServiceTestCase;

class MailingServiceServiceTest extends ApiServiceTestCase
{

    /**
     * @return MailingService
     */
    protected function newService()
    {
        return new MailingService(
            $this->client,
            $this->responseFactory,
            new ParameterFactory()
        );
    }

    public function testQuery()
    {
        $this->newService()->query();
        $this->assertHttpMethod('GET');
        $this->assertEndpointUri('mailings');
        $this->assertResourceKey('mailings');
    }

    public function testGet()
    {
        $this->newService()->get(123);
        $this->assertHttpMethod('GET');
        $this->assertEndpointUri('mailings/123');
    }

    public function testDelete()
    {
        $this->client->setExpectedResponse(new Response(204));
        $response = $this->newService()->delete(123);
        $this->assertHttpMethod('DELETE');
        $this->assertEndpointUri('mailings/123');
        $this->assertTrue($response);
    }

    public function testCreate()
    {
        $this->newService()->create();
        $this->assertHttpMethod('POST');
        $this->assertEndpointUri('mailings');
    }

    public function testPause()
    {
        $this->newService()->pause(123);
        $this->assertHttpMethod('POST');
        $this->assertEndpointUri('mailings/123/pause');
    }

    public function testCancel()
    {
        $this->newService()->cancel(123, 'reason');
        $this->assertHttpMethod('POST');
        $this->assertEndpointUri('mailings/123/cancel');
    }

}