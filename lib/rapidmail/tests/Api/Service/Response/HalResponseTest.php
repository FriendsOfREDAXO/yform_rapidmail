<?php

namespace Rapidmail\ApiClientTests\Api\Service\Response;

use Rapidmail\ApiClient\Exception\NotImplementedException;
use Rapidmail\ApiClient\Service\Response\HalResponse;
use Rapidmail\ApiClientTests\Mock\HttpClientMock;
use Rapidmail\ApiClientTests\Mock\ResponseFactoryMock;
use Yoast\PHPUnitPolyfills\TestCases\TestCase;

class HalResponseTest extends TestCase
{
    protected function newHalResponse($data = [], HalResponse $expectedNextResponse = null)
    {

        $responseFactory = new ResponseFactoryMock();

        if ($expectedNextResponse !== null) {
            $responseFactory->setExpectedHalResponse($expectedNextResponse);
        }

        return new HalResponse(
            new HttpClientMock(),
            $responseFactory,
            $data
        );

    }

    public function testRecursiveHalResponseStructure()
    {

        $response = $this->newHalResponse([
            'test' => 'abc',
            'outer' => [
                'inner' => 'test'
            ]
        ]);

        $this->assertInstanceOf(HalResponse::class, $response);
        $this->assertInstanceOf(HalResponse::class, $response['outer']);

    }

    public function testToArray()
    {

        $expected = [
            'test' => 'abc',
            'outer' => [
                'inner' => 'test'
            ]
        ];

        $this->assertEquals(
            $expected,
            $this->newHalResponse($expected)->toArray()
        );

    }

    public function testDebugInfo()
    {

        $expected = [
            'test' => 'abc',
            'outer' => [
                'inner' => 'test'
            ]
        ];

        $this->assertEquals(
            $expected,
            $this->newHalResponse($expected)->__debugInfo()
        );

    }

    public function testToString()
    {
        $expected = "Array([test]=>abc[outer]=>Array([inner]=>test))";
        $actual = $this
            ->newHalResponse(
                [
                    'test' => 'abc',
                    'outer' => [
                        'inner' => 'test'
                    ]
                ]
            )->__toString();

        $this->assertEquals($expected, preg_replace('~\s+~', '', $actual));
    }

    public function testIterator()
    {

        $expected = [
            'a' => 1,
            'b' => 2,
            'c' => 3
        ];

        $this->assertEquals(
            $expected,
            iterator_to_array(
                $this->newHalResponse($expected)
            )
        );

    }

    public function testOffsetAccess()
    {

        $response = $this->newHalResponse();
        $this->assertFalse($response->offsetExists('test'));

        $response = $this->newHalResponse(['test' => 'abc']);
        $this->assertTrue($response->offsetExists('test'));
        $this->assertEquals('abc', $response->offsetGet('test'));

    }

    public function testOffsetSetNotImplemented()
    {
        $this->expectException(NotImplementedException::class);
        $this->expectExceptionMessageMatches('/Write access is not implemented/');
        $response = $this->newHalResponse();
        $response->offsetSet('any', 'test');
    }

    public function testOffsetUnsetNotImplemented()
    {
        $this->expectException(NotImplementedException::class);
        $this->expectExceptionMessageMatches('/Write access is not implemented/');
        $response = $this->newHalResponse();
        $response->offsetUnset('any');
    }

    public function navigationDataProvider()
    {

        return [
            ['first'],
            ['last'],
            ['prev'],
            ['next']
        ];

    }

    /**
     * @dataProvider navigationDataProvider
     * @param string $target
     */
    public function testNavigate($target)
    {

        $response = $this->newHalResponse();
        $this->assertNull($response->{$target}());

        $response = $this->newHalResponse(
            [
                '_links' => [
                    $target => [
                        'href' => 'dummy'
                    ]
                ]
            ],
            $this->newHalResponse([
                'test' => $target
            ])
        );

        $subsequent = $response->{$target}();

        $this->assertInstanceOf(HalResponse::class, $subsequent);
        $this->assertEquals($target, $subsequent['test']);

    }

    public function testNavigateSelf()
    {
        $response = $this->newHalResponse([
            'test' => 'abc'
        ]);

        $this->assertEquals('abc', $response->self()->offsetGet('test'));

    }

}
