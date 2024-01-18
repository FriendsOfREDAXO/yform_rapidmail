<?php

namespace Rapidmail\ApiClient\Service\Response;

use Rapidmail\ApiClient\Util\CallbackIterator;

class HalResponsePaginationIterator implements ResponseInterface, \Iterator, \Countable
{

    /**
     * @var HalResponse
     */
    private $initial;

    /**
     * @var HalResponse
     */
    private $current;

    /**
     * Constructor
     *
     * @param HalResponse $response
     */
    public function __construct(HalResponse $response)
    {
        $this->initial = $response;
        $this->current = $this->initial;
    }

    /**
     * @inheritDoc
     */
    #[\ReturnTypeWillChange]
    public function current()
    {
        return $this->current;
    }

    /**
     * @inheritDoc
     */
    #[\ReturnTypeWillChange]
    public function next()
    {
        $this->current = $this->current->next();
    }

    /**
     * @inheritDoc
     */
    #[\ReturnTypeWillChange]
    public function key()
    {
        return $this->current['page'];
    }

    /**
     * @inheritDoc
     */
    #[\ReturnTypeWillChange]
    public function valid()
    {
        return $this->current !== null;
    }

    /**
     * @inheritDoc
     */
    #[\ReturnTypeWillChange]
    public function rewind()
    {
        $this->current = $this->initial;
    }

    /**
     * @inheritDoc
     */
    #[\ReturnTypeWillChange]
    public function count()
    {
        return $this->current['page_count'];
    }

    /**
     * @return int
     */
    public function totalCount()
    {
        return $this->current['total_items'];
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
