<?php

namespace Rapidmail\ApiClient;

use Rapidmail\ApiClient\Exception\IncompatiblePlatformException;
use Rapidmail\ApiClient\Exception\NotImplementedException;
use Rapidmail\ApiClient\Http\HttpClientFactory;
use Rapidmail\ApiClient\Service\ServiceFactory;
use Rapidmail\ApiClient\Util\PlatformRequirements;

if (is_file(__DIR__ . '/../vendor/autoload.php')) {
    require_once __DIR__ . '/../vendor/autoload.php';
}

/**
 * rapidmail API v3 client
 */
class Client
{

    /**
     * @var string
     */
    const VERSION = '1.0.0';

    /**
     * @var ServiceFactory
     */
    private $serviceFactory;

    /**
     * Constructor
     *
     * @param string $username
     * @param string $password
     * @throws IncompatiblePlatformException
     */
    public function __construct(...$args)
    {

        // Assume username + password by default

        $config = [
            'auth' => [
                isset($args[0]) && is_string($args[0]) ? $args[0] : '',
                isset($args[1]) && is_string($args[1]) ? $args[1] : ''
            ]
        ];

        // Assume a configuration array was provided

        if (isset($args[0]) && is_array($args[0])) {
            $config = $args[0];
        }

        // Assume

        (new PlatformRequirements())->assertPlatformRequirements();

        $this->serviceFactory = new ServiceFactory(
            new HttpClientFactory(),
            $config
        );

    }

    /**
     * Creates a new mailing service
     *
     * @param string|null $version
     * @return \Rapidmail\ApiClient\Service\V1\Api\Mailings\Mailing\MailingService
     * @throws NotImplementedException
     */
    public function mailings($version = null)
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return $this->serviceFactory->createService('mailings', $version);
    }

    /**
     * Creates a new mailing recipients service
     *
     * @param string|null $version
     * @return \Rapidmail\ApiClient\Service\V1\Api\Mailings\MailingRecipients\MailingRecipientsService
     * @throws NotImplementedException
     */
    public function mailingRecipients($version = null)
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return $this->serviceFactory->createService('mailing_recipients', $version);
    }

    /**
     * Creates a new mailing stats service
     *
     * @param string|null $version
     * @return \Rapidmail\ApiClient\Service\V1\Api\Mailings\MailingStats\MailingStatsService
     * @throws NotImplementedException
     */
    public function mailingStats($version = null)
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return $this->serviceFactory->createService('mailing_stats', $version);
    }

    /**
     * Creates a new mailing stats anonymize service
     *
     * @param string|null $version
     * @return \Rapidmail\ApiClient\Service\V1\Api\Mailings\MailingStatsAnonymize\MailingStatsAnonymizeService
     * @throws NotImplementedException
     */
    public function mailingStatsAnonymize($version = null)
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return $this->serviceFactory->createService('mailing_stats_anonymize', $version);
    }

    /**
     * Creates a new API service to manage recipientlists
     *
     * @param string|null $version
     * @return \Rapidmail\ApiClient\Service\V1\Api\Recipientlists\Recipientlist\RecipientlistService
     * @throws NotImplementedException
     */
    public function recipientlists($version = null)
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return $this->serviceFactory->createService('recipientlists', $version);
    }

    /**
     * Creates a new API service to manage recipients
     *
     * @param string|null $version
     * @return \Rapidmail\ApiClient\Service\V1\Api\Recipients\Recipient\RecipientService
     * @throws NotImplementedException
     */
    public function recipients($version = null)
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return $this->serviceFactory->createService('recipients', $version);
    }

    /**
     * Creates a new API service to manage jobs
     *
     * @param string|null $version
     * @return \Rapidmail\ApiClient\Service\V1\Api\Jobs\Job\JobService
     * @throws NotImplementedException
     */
    public function jobs($version = null)
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return $this->serviceFactory->createService('jobs', $version);
    }

    /**
     * Creates a new API service to fetch transactional emails
     *
     * @param string|null $version
     * @return \Rapidmail\ApiClient\Service\V1\Api\TrxEmails\TrxEmail\TrxEmailService
     * @throws NotImplementedException
     */
    public function transactionEmails($version = null)
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return $this->serviceFactory->createService('trx_emails', $version);
    }

    /**
     * Creates a new API service to manage API users
     *
     * @param string|null $version
     * @return \Rapidmail\ApiClient\Service\V1\Api\ApiUsers\ApiUser\ApiUserService
     * @throws NotImplementedException
     */
    public function apiUsers($version = null)
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return $this->serviceFactory->createService('apiusers', $version);
    }

    /**
     * Creates a new API service to manage blacklist entries
     *
     * @param string|null $version
     * @return \Rapidmail\ApiClient\Service\V1\Api\Blacklist\Blacklist\BlacklistService
     * @throws NotImplementedException
     */
    public function blacklist($version = null)
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return $this->serviceFactory->createService('blacklist', $version);
    }

}