<?php

namespace Rapidmail\ApiClient\Service\V1\Api\Mailings\MailingStats;

use Rapidmail\ApiClient\Http\HttpClientInterface;
use Rapidmail\ApiClient\Service\Response\ResponseFactory;
use Rapidmail\ApiClient\Service\ServiceFactoryInterface;

class MailingStatsServiceFactory implements ServiceFactoryInterface
{

    /**
     * @inheritDoc
     */
    public function create($dependencies = [])
    {

        return new MailingStatsService(
            $dependencies[HttpClientInterface::class],
            $dependencies[ResponseFactory::class]
        );

    }

}
