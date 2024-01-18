<?php

namespace Rapidmail\ApiClient\Util;

class CallbackIterator implements \Iterator
{

    /**
     * @var \Iterator
     */
    private $iterator;

    /**
     * @var \Closure
     */
    private $callback;

    /**
     * Constructor
     *
     * @param \Iterator $iterator
     * @param \Closure $callback
     */
    public function __construct(\Iterator $iterator, \Closure $callback)
    {
        $this->iterator = $iterator;
        $this->callback = $callback;
    }

    /**
     * @inheritDoc
     */
    #[\ReturnTypeWillChange]
    public function current()
    {

        return $this->callback->__invoke(
            $this->iterator->current()
        );

    }

    /**
     * @inheritDoc
     */
    #[\ReturnTypeWillChange]
    public function next()
    {
        $this->iterator->next();
    }

    /**
     * @inheritDoc
     */
    #[\ReturnTypeWillChange]
    public function key()
    {
        return $this->iterator->key();
    }

    /**
     * @inheritDoc
     */
    #[\ReturnTypeWillChange]
    public function valid()
    {
        return $this->iterator->valid();
    }

    /**
     * @inheritDoc
     */
    #[\ReturnTypeWillChange]
    public function rewind()
    {
        $this->iterator->rewind();
    }

}
