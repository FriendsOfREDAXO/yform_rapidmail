<?php

namespace Rapidmail\ApiClientTests\Api\Service\Parameter;

use InvalidArgumentException;
use Rapidmail\ApiClient\Service\Parameter\FileAttr;
use Yoast\PHPUnitPolyfills\TestCases\TestCase;

class FileAttrTest extends TestCase
{

    public function testFailsIfContentEmpfy()
    {
        $attr = new FileAttr();
        $this->expectException(InvalidArgumentException::class);
        $attr->setContent('');
    }

    /**
     * @dataProvider base64provider
     * @param string $content
     * @doesNotPerformAssertions
     */
    public function testValidateBase64Content($content)
    {
        $attr = new FileAttr();
        $attr->setContent($content);
    }

    public function base64provider()
    {
        return [
            [ // small base64 payload
                base64_encode('foooobarr')
            ],
            [ // large base64 payload
                base64_encode(str_repeat('foooobarr', 1000000))
            ],
            [
                'RGllcyBpc3QgZWluIHp1IGtvZGllcmVuZGVyIFN0cmluZw=='
            ],
            [
                'YXNkdHLDnzA5N3FuM8OfIHVpYzlwb0FTSUpLREZNTiBWISTCpyUmTcK0PSkhScKnUSTCtD89SUHDnFNQSkNNw5xQT0ZJVUpBU8OcVEdEVU0gwrQ/PUEpU1VJRkdBRFNGRw=='
            ]
        ];
    }

    /**
     * @dataProvider invalidBase64Provider
     * @param string $content
     */
    public function testThrowsOnInvalidBase64($content)
    {
        $attr = new FileAttr();
        $this->expectException(InvalidArgumentException::class);
        $attr->setContent($content);
    }

    public function invalidBase64Provider()
    {
        return [
            [
                '***'
            ],
            [
                'äöü'
            ],
            [
                'ääää==='
            ],
            [
                ',.,.'
            ]
        ];
    }
}
