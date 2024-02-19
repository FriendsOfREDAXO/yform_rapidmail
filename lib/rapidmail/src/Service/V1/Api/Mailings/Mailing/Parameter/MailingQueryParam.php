<?php

namespace Rapidmail\ApiClient\Service\V1\Api\Mailings\Mailing\Parameter;

use Rapidmail\ApiClient\Exception\InvalidArgumentException;
use Rapidmail\ApiClient\Service\Parameter\GenericParameter;

class MailingQueryParam extends GenericParameter
{

    /**
     * @var string[]
     */
    const STATUS_VALUES = [
        'draft',
        'scheduled',
        'preparing',
        'prepared',
        'queueing',
        'sending',
        'sent_split',
        'sent',
        'canceled',
        'deleted'
    ];

    /**
     * @inheritDoc
     */
    protected function getKnownAttributeKeys()
    {

        return [
            'page',
            'status',
            'created_since',
            'updated_since'
        ];

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
     * Sets the status filter
     *
     * @param string $status
     * @return static
     */
    public function setStatus($status)
    {

        if (!in_array($status, static::STATUS_VALUES)) {

            throw new InvalidArgumentException(
                'Invalid status provided. Must be one of: ' . implode(', ', static::STATUS_VALUES)
            );

        }

        $this->setAttributeRaw('status', $status);

        return $this;
    }

    /**
     * Sets the mailings created since datetime filter
     *
     * @param string|\DateTimeInterface $dateTime
     *
     * @return static
     */
    public function setCreatedSince($dateTime)
    {
        $this->setAttributeRaw('created_since', $this->stringifyDateTime($dateTime));

        return $this;
    }

    /**
     * Sets the mailings updated since datetime filter
     *
     * @param string|\DateTimeInterface $dateTime
     *
     * @return static
     */
    public function setUpdatedSince($dateTime)
    {
        $this->setAttributeRaw('updated_since', $this->stringifyDateTime($dateTime));

        return $this;
    }

}
