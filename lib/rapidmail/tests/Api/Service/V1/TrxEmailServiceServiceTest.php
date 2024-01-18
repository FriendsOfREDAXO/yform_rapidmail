<?php

namespace Rapidmail\ApiClientTest\Api\Service\V1;

use Rapidmail\ApiClient\Service\V1\Api\TrxEmails\TrxEmail\Parameter\ParameterFactory;
use Rapidmail\ApiClient\Service\V1\Api\TrxEmails\TrxEmail\TrxEmailService;
use Rapidmail\ApiClientTests\Api\ApiServiceTestCase;

class TrxEmailServiceServiceTest extends ApiServiceTestCase
{

    /**
     * @return TrxEmailService
     */
    protected function newService()
    {
        return new TrxEmailService(
            $this->client,
            $this->responseFactory,
            new ParameterFactory()
        );
    }

    public function testQuery()
    {
        $this->newService()->query();
        $this->assertHttpMethod('GET');
        $this->assertEndpointUri('trx/emails');
        $this->assertResourceKey('trxemails');
    }

    public function testGet()
    {
        $this->newService()->get('000943edb95fda08cfe7f22377d7054280f452a950A2');
        $this->assertHttpMethod('GET');
        $this->assertEndpointUri('trx/emails/000943edb95fda08cfe7f22377d7054280f452a950A2');
    }

}