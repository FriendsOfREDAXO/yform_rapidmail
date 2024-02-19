<?php

return [
    'connection' => [
        'base_uri' => 'https://apiv3.emailsys.net',
        'throttle_interval' => 1, // in seconds
        'throttle_requests_per_interval' => 10
    ],
    'services' => [
        'mailings' => [
            'current' => 'v1',
            'config' => [
                'v1' => [
                    'factory_class' => \Rapidmail\ApiClient\Service\V1\Api\Mailings\Mailing\MailingServiceFactory::class
                ]
            ]
        ],
        'mailing_recipients' => [
            'current' => 'v1',
            'config' => [
                'v1' => [
                    'factory_class' => \Rapidmail\ApiClient\Service\V1\Api\Mailings\MailingRecipients\MailingRecipientsServiceFactory::class
                ]
            ]
        ],
        'mailing_stats' => [
            'current' => 'v1',
            'config' => [
                'v1' => [
                    'factory_class' => \Rapidmail\ApiClient\Service\V1\Api\Mailings\MailingStats\MailingStatsServiceFactory::class
                ]
            ]
        ],
        'mailing_stats_anonymize' => [
            'current' => 'v1',
            'config' => [
                'v1' => [
                    'factory_class' => \Rapidmail\ApiClient\Service\V1\Api\Mailings\MailingStatsAnonymize\MailingStatsAnonymizeServiceFactory::class
                ]
            ]
        ],
        'recipientlists' => [
            'current' => 'v1',
            'config' => [
                'v1' => [
                    'factory_class' => \Rapidmail\ApiClient\Service\V1\Api\Recipientlists\Recipientlist\RecipientlistServiceFactory::class
                ]
            ]
        ],
        'recipients' => [
            'current' => 'v1',
            'config' => [
                'v1' => [
                    'factory_class' => \Rapidmail\ApiClient\Service\V1\Api\Recipients\Recipient\RecipientServiceFactory::class
                ]
            ]
        ],
        'jobs' => [
            'current' => 'v1',
            'config' => [
                'v1' => [
                    'factory_class' => \Rapidmail\ApiClient\Service\V1\Api\Jobs\Job\JobServiceFactory::class
                ]
            ]
        ],
        'trx_emails' => [
            'current' => 'v1',
            'config' => [
                'v1' => [
                    'factory_class' => \Rapidmail\ApiClient\Service\V1\Api\TrxEmails\TrxEmail\TrxEmailsServiceFactory::class
                ]
            ]
        ],
        'apiusers' => [
            'current' => 'v1',
            'config' => [
                'v1' => [
                    'factory_class' => \Rapidmail\ApiClient\Service\V1\Api\ApiUsers\ApiUser\ApiUserServiceFactory::class
                ]
            ]
        ],
        'blacklist' => [
            'current' => 'v1',
            'config' => [
                'v1' => [
                    'factory_class' => \Rapidmail\ApiClient\Service\V1\Api\Blacklist\Blacklist\BlacklistServiceFactory::class
                ]
            ]
        ]
    ]
];
