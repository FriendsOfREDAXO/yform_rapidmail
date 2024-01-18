<?php

namespace Rapidmail\ApiClient\Service\V1\Api\TrxEmails\TrxEmail;

use Rapidmail\ApiClient\Http\HttpClientInterface;
use Rapidmail\ApiClient\Service\Response\ResponseFactory;
use Rapidmail\ApiClient\Service\ServiceFactoryInterface;
use Rapidmail\ApiClient\Service\V1\Api\TrxEmails\TrxEmail\Parameter\ParameterFactory;

class TrxEmailsServiceFactory implements ServiceFactoryInterface
{

    /**
     * @inheritDoc
     */
    public function create($dependencies = [])
    {

        return new TrxEmailService(
            $dependencies[HttpClientInterface::class],
            $dependencies[ResponseFactory::class],
            new ParameterFactory()
        );

    }

}