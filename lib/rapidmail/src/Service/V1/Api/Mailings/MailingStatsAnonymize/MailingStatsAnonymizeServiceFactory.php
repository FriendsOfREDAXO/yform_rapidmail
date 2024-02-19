<?php

namespace Rapidmail\ApiClient\Service\V1\Api\Mailings\MailingStatsAnonymize;

use Rapidmail\ApiClient\Http\HttpClientInterface;
use Rapidmail\ApiClient\Service\Response\ResponseFactory;
use Rapidmail\ApiClient\Service\ServiceFactoryInterface;

class MailingStatsAnonymizeServiceFactory implements ServiceFactoryInterface
{

    /**
     * @inheritDoc
     */
    public function create($dependencies = [])
    {
        return new MailingStatsAnonymizeService(
            $dependencies[HttpClientInterface::class],
            $dependencies[ResponseFactory::class]
        );

    }

}
