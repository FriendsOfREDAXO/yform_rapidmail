<?php

namespace Rapidmail\ApiClientTests\Mock;

use Rapidmail\ApiClient\Service\Parameter\GenericParameter;

class GenericParameterMock extends GenericParameter
{

    /**
     * @var int
     */
    private $knownAttributeSetterCallCount = 0;

    /**
     * @return int
     */
    public function getKnownAttributeSetterCallCount()
    {
        return $this->knownAttributeSetterCallCount;
    }

    /**
     * Returns the KnownAttributeKeys
     *
     * @return array
     */
    public function getKnownAttributeKeys()
    {

        return [
            'unknown_attribute',
            'known_attribute'
        ];

    }

    /**
     * @param array $knownAttributeKeys
     * @return GenericParameterMock
     */
    public function setKnownAttributeKeys(array $knownAttributeKeys)
    {
        $this->knownAttributeKeys = $knownAttributeKeys;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function stringifyDateTime($dateTime, $format = 'Y-m-d H:i:s')
    {
        return parent::stringifyDateTime($dateTime, $format);
    }

    /**
     * @inheritDoc
     */
    public function convertBool($input)
    {
        return parent::convertBool($input);
    }

    /**
     * Proxy method for a known attribute
     *
     * @param mixed $value
     * @return static
     */
    public function setKnownAttribute($value)
    {
        $this->knownAttributeSetterCallCount++;

        $this->setAttributeRaw('known_attribute', $value);

        return $this;

    }

}
