<?php

namespace Rapidmail\ApiClient\Service\Response;

use Rapidmail\ApiClient\Exception\ApiException;
use Rapidmail\ApiClient\Exception\NotImplementedException;
use Rapidmail\ApiClient\Http\HttpClientInterface;

class HalResponse implements ResponseInterface, \ArrayAccess, \IteratorAggregate
{

    /**
     * @var HttpClientInterface
     */
    private $client;

    /**
     * @var ResponseFactory
     */
    private $responseFactory;

    /**
     * @var array
     */
    private $links = [];

    /**
     * @var array
     */
    private $data = [];

    /**
     * Constructor
     *
     * @param HttpClientInterface $client
     * @param ResponseFactory $responseFactory
     * @param array $data
     */
    public function __construct(HttpClientInterface $client, ResponseFactory $responseFactory, array $data = [])
    {

        $this->client = $client;
        $this->responseFactory = $responseFactory;

        if (isset($data['_links'])) {
            $this->links = $data['_links'];
            unset($data['_links']);
        }

        $data = array_map(
            function ($item) {
                return is_array($item) ? new static($this->client, $this->responseFactory, $item) : $item;
            },
            $data
        );

        $this->data = $data;
    }

    /**
     * @inheritDoc
     */
    #[\ReturnTypeWillChange]
    public function offsetExists($offset)
    {
        return isset($this->data[$offset]);
    }

    /**
     * @inheritDoc
     */
    #[\ReturnTypeWillChange]
    public function offsetGet($offset)
    {
        return $this->data[$offset];
    }

    /**
     * @inheritDoc
     */
    #[\ReturnTypeWillChange]
    public function offsetSet($offset, $value)
    {
        throw new NotImplementedException('Write access is not implemented for ' . static::class);
    }

    /**
     * @inheritDoc
     */
    #[\ReturnTypeWillChange]
    public function offsetUnset($offset)
    {
        throw new NotImplementedException('Write access is not implemented for ' . static::class);
    }

    /**
     * @return array
     */
    public function toArray()
    {

        return array_map(
            function ($item) {
                return $item instanceof static ? $item->toArray() : $item;
            },
            $this->data
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

    /**
     * @return HalResponse
     */
    public function self()
    {
        return $this;
    }

    /**
     * @return HalResponse|null
     * @throws ApiException
     */
    public function next()
    {
        return $this->navigate('next');
    }

    /**
     * @return HalResponse|null
     * @throws ApiException
     */
    public function prev()
    {
        return $this->navigate('prev');
    }

    /**
     * @return HalResponse|null
     * @throws ApiException
     */
    public function first()
    {
        return $this->navigate('first');
    }

    /**
     * @return HalResponse|null
     * @throws ApiException
     */
    public function last()
    {
        return $this->navigate('last');
    }

    /**
     * Navigate Hal links
     *
     * @param string $target
     * @return HalResponse|null
     * @throws ApiException
     */
    protected function navigate($target)
    {

        if (!isset($this->links[$target]) || !isset($this->links[$target]['href'])) {
            return null;
        }

        return $this->responseFactory->newHalResponse(
            $this->client,
            $this
                ->client
                ->request(
                    'GET',
                    $this->links[$target]['href']
                )
        );

    }

    /**
     * @inheritDoc
     */
    #[\ReturnTypeWillChange]
    public function getIterator()
    {
        return new \ArrayIterator($this->data);
    }

}
