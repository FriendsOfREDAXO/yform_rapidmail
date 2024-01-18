<?php

namespace Rapidmail\ApiClientTests\Api\Service\V1;

use GuzzleHttp\Psr7\Response;
use Rapidmail\ApiClient\Service\V1\Api\Recipients\Recipient\Parameter\ParameterFactory;
use Rapidmail\ApiClient\Service\V1\Api\Recipients\Recipient\RecipientService;
use Rapidmail\ApiClientTests\Api\ApiServiceTestCase;

class RecipientServiceServiceTest extends ApiServiceTestCase
{

    /**
     * @return RecipientService
     */
    protected function newService()
    {
        return new RecipientService(
            $this->client,
            $this->responseFactory,
            new ParameterFactory()
        );
    }

    public function testQuery()
    {
        $this->newService()->query();
        $this->assertHttpMethod('GET');
        $this->assertEndpointUri('recipients');
        $this->assertResourceKey('recipients');
    }

    public function testGet()
    {
        $this->newService()->get(123);
        $this->assertHttpMethod('GET');
        $this->assertEndpointUri('recipients/123');
    }

    public function testDelete()
    {
        $this->client->setExpectedResponse(new Response(204));
        $response = $this->newService()->delete(123);
        $this->assertHttpMethod('DELETE');
        $this->assertEndpointUri('recipients/123');
        $this->assertTrue($response);
    }

    public function testCreate()
    {
        $this->newService()->create();
        $this->assertHttpMethod('POST');
        $this->assertEndpointUri('recipients');
    }

    public function testUpdate()
    {
        $this->newService()->update(123);
        $this->assertHttpMethod('PATCH');
        $this->assertEndpointUri('recipients/123');
    }

    public function testImport()
    {
        $this->newService()->import();
        $this->assertHttpMethod('POST');
        $this->assertEndpointUri('recipients/import');
    }

}