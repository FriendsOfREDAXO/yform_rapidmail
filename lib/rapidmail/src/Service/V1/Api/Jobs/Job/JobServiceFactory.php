<?php

namespace Rapidmail\ApiClient\Service\V1\Api\Jobs\Job;

use Rapidmail\ApiClient\Http\HttpClientInterface;
use Rapidmail\ApiClient\Service\Response\ResponseFactory;
use Rapidmail\ApiClient\Service\ServiceFactoryInterface;

class JobServiceFactory implements ServiceFactoryInterface
{

    /**
     * @inheritDoc
     */
    public function create($dependencies = [])
    {

        return new JobService(
            $dependencies[HttpClientInterface::class],
            $dependencies[ResponseFactory::class]
        );

    }

}