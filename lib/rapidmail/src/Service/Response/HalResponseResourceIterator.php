<?php

namespace Rapidmail\ApiClient\Service\Response;

use Rapidmail\ApiClient\Util\CallbackIterator;

/**
 * Iterate all resources within a paged HAL response collection
 */
class HalResponseResourceIterator implements ResponseInterface, \Iterator, \Countable
{

    /**
     * @var int
     */
    private $currentIndex = 0;

    /**
     * @var null|\ArrayIterator
     */
    private $currentResourceIterator;

    /**
     * @var HalResponsePaginationIterator
     */
    private $responseCollection;

    /**
     * @var string
     */
    private $embeddedResourcePathKey;

    /**
     * Constructor
     *
     * @param HalResponsePaginationIterator $responseCollection
     * @param string $embeddedResourcePathKey
     */
    public function __construct(
        HalResponsePaginationIterator $responseCollection,
        $embeddedResourcePathKey
    ) {
        $this->responseCollection = $responseCollection;
        $this->embeddedResourcePathKey = $embeddedResourcePathKey;
    }

    /**
     * @inheritDoc
     */
    #[\ReturnTypeWillChange]
    public function current()
    {
        return $this->currentResourceIterator->current();
    }

    /**
     * @inheritDoc
     */
    #[\ReturnTypeWillChange]
    public function next()
    {

        $this->currentResourceIterator->next();

        if (!$this->currentResourceIterator->valid()) {
            $this->responseCollection->next();
            $this->currentResourceIterator = $this->createIteratorFromInnerResource();
        }

        $this->currentIndex++;

    }

    /**
     * @inheritDoc
     */
    #[\ReturnTypeWillChange]
    public function key()
    {
        return $this->currentIndex;
    }

    /**
     * @inheritDoc
     */
    #[\ReturnTypeWillChange]
    public function valid()
    {
        return $this->currentResourceIterator !== null && $this->currentResourceIterator->valid();
    }

    /**
     * @inheritDoc
     */
    #[\ReturnTypeWillChange]
    public function rewind()
    {
        $this->currentIndex = 0;
        $this->responseCollection->rewind();
        $this->currentResourceIterator = $this->createIteratorFromInnerResource();
    }

    /**
     * @inheritDoc
     */
    #[\ReturnTypeWillChange]
    public function count()
    {
        return $this->responseCollection->totalCount();
    }

    /**
     * @return null|\Iterator
     */
    private function createIteratorFromInnerResource()
    {

        if (!$this->responseCollection->valid()) {
            return null;
        }

        /** @var HalResponse $halResponse */
        $halResponse = $this->responseCollection->current();

        $canAccessInnerResources = isset($halResponse['_embedded'])
            && isset($halResponse['_embedded'][$this->embeddedResourcePathKey]);

        if (!$canAccessInnerResources) {
            return null;
        }

        $innerResource = $halResponse['_embedded'][$this->embeddedResourcePathKey];

        if (!$innerResource instanceof HalResponse) {
            return null;
        }

        return $innerResource->getIterator();

    }

    /**
     * @return array
     */
    protected function toArray()
    {

        return iterator_to_array(
            new CallbackIterator(
                $this,
                function ($item) {
                    return $item instanceof HalResponse ? $item->toArray() : $item;
                }
            )
        );

    }

    /**
     * @inheritDoc
     */
    public function __debugInfo()
    {
        return $this->toArray();
    }

    /**
     * @inheritDoc
     */
    public function __toString()
    {
        return (string)print_r($this->toArray(), true);
    }

}
