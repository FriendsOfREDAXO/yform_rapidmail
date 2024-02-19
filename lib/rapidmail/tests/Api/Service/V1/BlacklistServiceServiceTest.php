<?php

namespace Rapidmail\ApiClientTests\Api\Service\V1;

use GuzzleHttp\Psr7\Response;
use Rapidmail\ApiClient\Service\V1\Api\Blacklist\Blacklist\BlacklistService;
use Rapidmail\ApiClient\Service\V1\Api\Blacklist\Blacklist\Parameter\ParameterFactory;
use Rapidmail\ApiClientTests\Api\ApiServiceTestCase;

class BlacklistServiceServiceTest extends ApiServiceTestCase
{

    /**
     * @return BlacklistService
     */
    protected function newService()
    {
        return new BlacklistService(
            $this->client,
            $this->responseFactory,
            new ParameterFactory()
        );
    }

    public function testQuery()
    {
        $this->newService()->query();
        $this->assertHttpMethod('GET');
        $this->assertEndpointUri('blacklist');
        $this->assertResourceKey('blacklist');
    }

    public function testGet()
    {
        $this->newService()->get(123);
        $this->assertHttpMethod('GET');
        $this->assertEndpointUri('blacklist/123');
    }

    public function testDelete()
    {
        $this->client->setExpectedResponse(new Response(204));
        $response = $this->newService()->delete(123);
        $this->assertHttpMethod('DELETE');
        $this->assertEndpointUri('blacklist/123');
        $this->assertTrue($response);
    }

    public function testCreate()
    {
        $this->newService()->create();
        $this->assertHttpMethod('POST');
        $this->assertEndpointUri('blacklist');
    }

    public function testImport()
    {
        $this->newService()->import();
        $this->assertHttpMethod('POST');
        $this->assertEndpointUri('blacklist/import');
    }

}
