<?php

namespace Rapidmail\ApiClientTests\Api\Util;

use Rapidmail\ApiClient\Util\CallbackIterator;
use Yoast\PHPUnitPolyfills\TestCases\TestCase;

class CallbackIteratorTest extends TestCase
{
    public function test()
    {
        $array = [1, 2];
        $calls = 0;

        $iterator = new CallbackIterator(
            new \ArrayIterator($array),
            function () use (&$calls) {
                $calls++;
            }
        );

        iterator_to_array($iterator);

        $this->assertSame(2, $calls, 'callback must be called exactly twice');
    }
}
