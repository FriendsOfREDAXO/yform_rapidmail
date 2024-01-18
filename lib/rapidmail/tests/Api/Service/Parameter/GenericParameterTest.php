<?php

namespace Rapidmail\ApiClientTests\Api\Service\Parameter;

use Rapidmail\ApiClient\Exception\InvalidArgumentException;
use Rapidmail\ApiClient\Service\Parameter\GenericParameter;
use Rapidmail\ApiClientTests\Mock\GenericParameterMock;
use Yoast\PHPUnitPolyfills\TestCases\TestCase;

class GenericParameterTest extends TestCase
{

    public function testConstructorArgsMatchOutput()
    {

        $expected = [
            'x' => 1,
            'y' => 2
        ];

        $parameter = new GenericParameter($expected);

        $this->assertEquals($expected, $parameter->toArray());

    }

    public function testSetAttribute()
    {

        $parameter = new GenericParameter();

        $this->assertArrayNotHasKey('testKey', $parameter->toArray());

        $parameter->setAttribute('testKey', 'testValue');

        $array = $parameter->toArray();

        $this->assertCount(1, $array);
        $this->assertArrayHasKey('testKey', $array);
        $this->assertContains('testValue', $array);

    }

    public function convertBoolDataProvider()
    {

        return [
            [0, 'no'],
            [1, 'yes'],
            [false, 'no'],
            [true, 'yes'],
            ['0', 'no'],
            ['1', 'yes'],
            ['no', 'no'],
            ['yes', 'yes'],
            ['unknown', 'unknown'],
        ];

    }

    /**
     * @dataProvider convertBoolDataProvider
     * @param mixed $booleanLikeValue
     * @param string $expected
     * @throws \ReflectionException
     */
    public function testConvertBool($booleanLikeValue, $expected)
    {

        $mock = new GenericParameterMock();
        $result = $mock->convertBool($booleanLikeValue);

        $this->assertEquals($expected, $result);

    }

    public function testStringifyDateTime()
    {

        $mock = new GenericParameterMock();

        $date = new \DateTime();
        $date->setDate(2000, 03, 07);
        $date->setTime(15, 21, 23);

        $result = $mock->stringifyDateTime($date);

        $this->assertEquals('2000-03-07 15:21:23', $result);

        $result = $mock->stringifyDateTime($date, 'Y-m-d');
        $this->assertEquals('2000-03-07', $result);

        $result = $mock->stringifyDateTime('2000-03-07 15:21:23');
        $this->assertEquals('2000-03-07 15:21:23', $result);

    }

    public function testStringifyDateTimeInvalidArgumentException()
    {
        $this->expectException(InvalidArgumentException::class);
        (new GenericParameterMock())->stringifyDateTime(false);
    }

    public function testKnownAttributeSetter() {

        $mock = new GenericParameterMock();

        $this->assertEquals(0, $mock->getKnownAttributeSetterCallCount());

        $mock = new GenericParameterMock([
            'unknown_attribute' => 'abc',
            'known_attribute' => 'def'
        ]);

        $this->assertEquals(1, $mock->getKnownAttributeSetterCallCount());

    }

}
