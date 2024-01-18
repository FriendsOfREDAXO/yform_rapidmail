<?php

namespace Rapidmail\ApiClient\Exception;

use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class ApiException extends \Exception implements ApiClientException
{

    /**
     * Convert a Guzzle exception into an API exception
     *
     * @param GuzzleException $e
     * @return self
     */
    public static function fromGuzzleException(GuzzleException $e)
    {

        $message = $e->getMessage();

        if (method_exists($e, 'hasResponse') && method_exists($e, 'getResponse')) {

            if ($e->hasResponse()) {

                $uri = '';

                if (method_exists($e, 'getRequest')) {
                    /** @var RequestInterface $request */
                    $request = $e->getRequest();
                    $uri = $request->getUri();
                }

                /** @var ResponseInterface $response */
                $response = $e->getResponse();

                $message = "API error {$e->getCode()} when requesting {$uri}. Detail: {$response->getBody()}";

            }

        }

        return new static($message, $e->getCode());

    }

}