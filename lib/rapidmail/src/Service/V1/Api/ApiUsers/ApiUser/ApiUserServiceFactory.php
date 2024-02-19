<?php

namespace Rapidmail\ApiClient\Service\V1\Api\ApiUsers\ApiUser;

use Rapidmail\ApiClient\Http\HttpClientInterface;
use Rapidmail\ApiClient\Service\Response\ResponseFactory;
use Rapidmail\ApiClient\Service\ServiceFactoryInterface;
use Rapidmail\ApiClient\Service\V1\Api\ApiUsers\ApiUser\Parameter\ParameterFactory;

class ApiUserServiceFactory implements ServiceFactoryInterface
{

    /**
     * @inheritDoc
     */
    public function create($dependencies = [])
    {

        return new ApiUserService(
            $dependencies[HttpClientInterface::class],
            $dependencies[ResponseFactory::class],
            new ParameterFactory()
        );

    }

}
