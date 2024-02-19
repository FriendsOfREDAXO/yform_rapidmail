<?php

namespace Rapidmail\ApiClient\Service\V1\Api\Blacklist\Blacklist;

use Rapidmail\ApiClient\Http\HttpClientInterface;
use Rapidmail\ApiClient\Service\Response\ResponseFactory;
use Rapidmail\ApiClient\Service\ServiceFactoryInterface;
use Rapidmail\ApiClient\Service\V1\Api\Blacklist\Blacklist\Parameter\ParameterFactory;

class BlacklistServiceFactory implements ServiceFactoryInterface
{

    /**
     * @inheritDoc
     */
    public function create($dependencies = [])
    {

        return new BlacklistService(
            $dependencies[HttpClientInterface::class],
            $dependencies[ResponseFactory::class],
            new ParameterFactory()
        );

    }

}
