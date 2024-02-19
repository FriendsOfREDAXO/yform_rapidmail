<?php

namespace Rapidmail\ApiClientTests\Api\Exception;

use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Rapidmail\ApiClient\Exception\ApiException;
use Yoast\PHPUnitPolyfills\TestCases\TestCase;

class ApiExceptionTest extends TestCase
{

    public function testApiExceptionFromGuzzleException()
    {

        $exception = ClientException::create(
            new Request('GET', 'https://example.net'),
            new Response(500, [], 'test')
        );

        $result = ApiException::fromGuzzleException($exception);

        $this->assertInstanceOf(ApiException::class, $result);
        $this->assertEquals(500, $result->getCode());
        $this->assertEquals('API error 500 when requesting https://example.net. Detail: test', $result->getMessage());

    }

}
