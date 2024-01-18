<?php

namespace Rapidmail\ApiClientTests\Api\Service\V1;

use GuzzleHttp\Psr7\Response;
use Rapidmail\ApiClient\Service\V1\Api\ApiUsers\ApiUser\ApiUserService;
use Rapidmail\ApiClient\Service\V1\Api\ApiUsers\ApiUser\Parameter\ParameterFactory;
use Rapidmail\ApiClientTests\Api\ApiServiceTestCase;

class ApiUsersServiceServiceTest extends ApiServiceTestCase
{

    /**
     * @return ApiUserService
     */
    protected function newService()
    {
        return new ApiUserService(
            $this->client,
            $this->responseFactory,
            new ParameterFactory()
        );
    }

    public function testQuery()
    {
        $this->newService()->query();
        $this->assertHttpMethod('GET');
        $this->assertEndpointUri('apiusers');
        $this->assertResourceKey('apiusers');
    }

    public function testGet()
    {
        $this->newService()->get(123);
        $this->assertHttpMethod('GET');
        $this->assertEndpointUri('apiusers/123');
    }

    public function testDelete()
    {
        $this->client->setExpectedResponse(new Response(204));
        $response = $this->newService()->delete(123);
        $this->assertHttpMethod('DELETE');
        $this->assertEndpointUri('apiusers/123');
        $this->assertTrue($response);
    }

    public function testCreate()
    {
        $this->newService()->create();
        $this->assertHttpMethod('POST');
        $this->assertEndpointUri('apiusers');
    }

    public function testUpdate()
    {
        $this->newService()->update(123);
        $this->assertHttpMethod('PATCH');
        $this->assertEndpointUri('apiusers/123');
    }

}