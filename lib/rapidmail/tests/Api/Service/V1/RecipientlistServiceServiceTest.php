<?php

namespace Rapidmail\ApiClientTests\Api\Service\V1;

use GuzzleHttp\Psr7\Response;
use Rapidmail\ApiClient\Service\V1\Api\Recipientlists\Recipientlist\Parameter\ParameterFactory;
use Rapidmail\ApiClient\Service\V1\Api\Recipientlists\Recipientlist\RecipientlistService;
use Rapidmail\ApiClientTests\Api\ApiServiceTestCase;

class RecipientlistServiceServiceTest extends ApiServiceTestCase
{

    /**
     * @return RecipientlistService
     */
    protected function newService()
    {
        return new RecipientlistService(
            $this->client,
            $this->responseFactory,
            new ParameterFactory()
        );
    }

    public function testQuery()
    {
        $this->newService()->query();
        $this->assertHttpMethod('GET');
        $this->assertEndpointUri('recipientlists');
        $this->assertResourceKey('recipientlists');
    }

    public function testGet()
    {
        $this->newService()->get(123);
        $this->assertHttpMethod('GET');
        $this->assertEndpointUri('recipientlists/123');
    }

    public function testDelete()
    {
        $this->client->setExpectedResponse(new Response(204));
        $response = $this->newService()->delete(123);
        $this->assertHttpMethod('DELETE');
        $this->assertEndpointUri('recipientlists/123');
        $this->assertTrue($response);
    }

    public function testCreate()
    {
        $this->newService()->create();
        $this->assertHttpMethod('POST');
        $this->assertEndpointUri('recipientlists');
    }

    public function testUpdate()
    {
        $this->newService()->update(123);
        $this->assertHttpMethod('PATCH');
        $this->assertEndpointUri('recipientlists/123');
    }

    public function testActivityStats()
    {
        $this->newService()->activityStats(123);
        $this->assertHttpMethod('GET');
        $this->assertEndpointUri('recipientlists/123/stats/activity');
    }

}