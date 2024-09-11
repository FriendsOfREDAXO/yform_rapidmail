<?php

namespace Rapidmail\ApiClient\Http;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\RequestOptions;

class HttpClientFactory
{

    /**
     * Create new ClientInterface instances
     *
     * @param array $config
     * @return HttpClientInterface
     */
    public function createClient(array $config = [])
    {

        $stack = HandlerStack::create();
        $stack->push(
            ThrottleMiddleware::getInstance(
                $config['throttle_interval'],
                $config['throttle_requests_per_interval']
            ), 'throttle'
        );

        $clientConfig = array_replace_recursive(
            $config,
            [
                'base_uri' => rtrim($config['base_uri'], '/') . '/' . $config['version'] . '/',
                'handler' => $stack,
                RequestOptions::HEADERS => [
                    'Accept' => 'application/json',
                    'User-Agent' => $this->buildUserAgentString()
                ]
            ]
        );
        unset($clientConfig['version']);

        return new HttpClientFacade(
            new Client($clientConfig)
        );

    }

    /**
     * @return string
     */
    private function buildUserAgentString()
    {

        return sprintf(
            'rapidmail-apiv3-client-php/%s (%s)',
            \Rapidmail\ApiClient\Client::VERSION,
            PHP_VERSION
        );

    }

}
