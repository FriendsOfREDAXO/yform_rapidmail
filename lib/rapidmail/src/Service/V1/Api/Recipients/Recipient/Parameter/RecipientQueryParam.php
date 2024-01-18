<?php

namespace Rapidmail\ApiClient\Service\V1\Api\Recipients\Recipient\Parameter;

use Rapidmail\ApiClient\Exception\InvalidArgumentException;
use Rapidmail\ApiClient\Service\Parameter\GenericParameter;

class RecipientQueryParam extends GenericParameter
{

    /**
     * @var string[]
     */
    const SORT_BY_VALUES = [
        'activated',
        'created',
        'updated'
    ];

    /**
     * @var string[]
     */
    const SORT_ORDER_VALUES = [
        'asc',
        'desc'
    ];

    /**
     * @inheritDoc
     */
    protected function getKnownAttributeKeys()
    {

        return [
            'recipientlist_id',
            'email',
            'foreign_id',
            'page',
            'sort_by',
            'sort_order',
            'status',
            'get_extra_big_fields'
        ];

    }

    /**
     * Sets the recipientlist ID to get recipients from (required)
     *
     * @param int $recipientlistId
     * @return static
     */
    public function setRecipientlistId($recipientlistId)
    {
        $this->setAttributeRaw('recipientlist_id', $recipientlistId);

        return $this;
    }

    /**
     * Filter recipients by email address
     *
     * @param string $email
     * @return static
     */
    public function setEmail($email)
    {
        $this->setAttributeRaw('email', $email);

        return $this;
    }

    /**
     * Filter recipients by foreign/external ID
     *
     * @param string $foreignId
     * @return static
     */
    public function setForeignId($foreignId)
    {
        $this->setAttributeRaw('foreign_id', $foreignId);

        return $this;
    }

    /**
     * Sets the page to load
     *
     * @param int $page
     * @return static
     */
    public function setPage($page)
    {
        $this->setAttributeRaw('page', $page);

        return $this;
    }

    /**
     * Sets the sort by
     *
     * @param string $sortBy
     * @return static
     */
    public function setSortBy($sortBy)
    {

        if (!in_array($sortBy, static::SORT_BY_VALUES)) {

            throw new InvalidArgumentException(
                'Invalid sort by provided. Must be one of: ' . implode(', ', static::SORT_BY_VALUES)
            );

        }

        $this->setAttributeRaw('sort_by', $sortBy);

        return $this;

    }

    /**
     * Order to sort in
     *
     * @param string $sortOrder
     * @return static
     */
    public function setSortOrder($sortOrder)
    {

        if (!in_array($sortOrder, static::SORT_ORDER_VALUES)) {

            throw new InvalidArgumentException(
                'Invalid sort order provided. Must be one of: ' . implode(', ', static::SORT_ORDER_VALUES)
            );

        }

        $this->setAttributeRaw('sort_order', $sortOrder);

        return $this;

    }

    /**
     * Filter by one or more status
     *
     * @param string|array $status
     * @return static
     */
    public function setStatus($status)
    {

        $this->setAttributeRaw('status', $status);

        return $this;

    }

    /**
     * If specified, extrabig fields will be returned for each recipient
     *
     * @param mixed $flag
     * @return static
     */
    public function setGetExtraBigFields($flag)
    {

        $this->setAttributeRaw('get_extra_big_fields', $this->convertBool($flag));

        return $this;

    }

}