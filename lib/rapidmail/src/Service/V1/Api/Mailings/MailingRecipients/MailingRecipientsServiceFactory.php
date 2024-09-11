<?php

namespace Rapidmail\ApiClient\Service\V1\Api\Mailings\MailingRecipients;

use Rapidmail\ApiClient\Http\HttpClientInterface;
use Rapidmail\ApiClient\Service\Response\ResponseFactory;
use Rapidmail\ApiClient\Service\ServiceFactoryInterface;

class MailingRecipientsServiceFactory implements ServiceFactoryInterface
{

    /**
     * @inheritDoc
     */
    public function create($dependencies = [])
    {

        return new MailingRecipientsService(
            $dependencies[HttpClientInterface::class],
            $dependencies[ResponseFactory::class]
        );

    }

}