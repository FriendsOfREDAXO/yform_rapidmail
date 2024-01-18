<?php

namespace Rapidmail\ApiClient\Service\Parameter;

use Rapidmail\ApiClient\Exception\InvalidArgumentException;

/**
 *  Generic method parameter
 */
class GenericParameter implements ParameterInterface
{

    /**
     * @var \ArrayObject
     */
    private $attributeStore;

    /**
     * Constructor
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {

        $this->attributeStore = new \ArrayObject();

        foreach ($attributes as $attributeKey => $attributeValue) {
            $this->setAttribute($attributeKey, $attributeValue);
        }

    }

    /**
     * Sets a single attribute
     *
     * @param string $key
     * @param mixed $value
     * @return static
     */
    public function setAttribute($key, $value)
    {

        $keys = $this->getKnownAttributeKeys();

        if (in_array($key, $keys)) {

            $setterMethod = 'set' . str_replace('_', '', ucwords($key, '_'));

            if (method_exists($this, $setterMethod)) {
                $this->{$setterMethod}($value);

                return $this;
            }

        }

        $this->setAttributeRaw($key, $value);

        return $this;

    }

    /**
     * Sets a single attribute
     *
     * @param string $key
     * @param mixed $value
     */
    protected function setAttributeRaw($key, $value)
    {
        $this->attributeStore->offsetSet($key, $value);
    }

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        return array_map(
            function ($value) {
                return $value instanceof ParameterInterface ? $value->toArray() : $value;
            },
            $this->attributeStore->getArrayCopy()
        );
    }

    /**
     * A list of known attribute keys that will be mapped to an appropriate setter method
     *
     * @return string[]
     */
    protected function getKnownAttributeKeys()
    {
        return [];
    }

    /**
     * Prepare date time string
     *
     * @param string|\DateTimeInterface $dateTime
     * @param string $format
     * @return string
     */
    protected function stringifyDateTime($dateTime, $format = 'Y-m-d H:i:s')
    {

        if ($dateTime instanceof \DateTimeInterface) {
            return $dateTime->format($format);
        }

        if (!is_string($dateTime)) {

            throw new InvalidArgumentException(
                'Date time must be either a string or an instance of \DateTimeInterface'
            );

        }

        return $dateTime;

    }

    /**
     * @param mixed
     * @return mixed
     */
    protected function convertBool($input)
    {

        if (!in_array($input, [false, true, 0, 1, '0', '1'], true)) {
            return $input;
        }

        return $input ? 'yes' : 'no';

    }

}