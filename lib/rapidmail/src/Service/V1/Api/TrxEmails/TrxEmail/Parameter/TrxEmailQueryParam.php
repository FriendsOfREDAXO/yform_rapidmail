<?php

namespace Rapidmail\ApiClient\Service\V1\Api\TrxEmails\TrxEmail\Parameter;

use Rapidmail\ApiClient\Exception\InvalidArgumentException;
use Rapidmail\ApiClient\Service\Parameter\GenericParameter;

class TrxEmailQueryParam extends GenericParameter
{

    /**
     * @inheritDoc
     */
    protected function getKnownAttributeKeys()
    {

        return [
            'page',
            'date_from',
            'date_to',
            'has_attachments',
            'activity_open',
            'activity_click',
            'activity_open_min',
            'activity_click_min',
            'status',
            'project_id',
            'search',
            'from',
            'to',
            'subject',
            'message'
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
     * Sets the from-date in Y-m-d format
     *
     * Should not be older than users subject retention date
     *
     * @param string|\DateTimeInterface $date
     * @return static
     */
    public function setDateFrom($date)
    {
        $this->setAttributeRaw('date_from', $this->stringifyDateTime($date, 'Y-m-d'));

        return $this;
    }

    /**
     * Sets the to-date in Y-m-d format
     *
     * Should not be older than users subject retention date or date_from
     *
     * @param string|\DateTimeInterface $date
     * @return static
     */
    public function setDateTo($date)
    {
        $this->setAttributeRaw('date_to', $this->stringifyDateTime($date, 'Y-m-d'));

        return $this;
    }

    /**
     * Filter for emails with(out) attachments
     *
     * @param mixed $flag
     * @return static
     */
    public function setHasAttachments($flag)
    {
        $this->setAttributeRaw('has_attachments', $this->convertBool($flag));

        return $this;
    }

    /**
     * Emails open count when tracking is enabled in transaction mail project settings
     *
     * Use in conjunction with setActivityOpenMin
     *
     * @param int $value
     * @return static
     */
    public function setActivityOpen($value)
    {

        $this->setAttributeRaw('activity_open', $value);

        return $this;
    }

    /**
     * Emails click count when tracking is enabled in transaction mail project settings
     *
     * Use in conjunction with setActivityClickMin
     *
     * @param int $value
     * @return static
     */
    public function setActivityClick($value)
    {

        $this->setAttributeRaw('activity_click', $value);

        return $this;
    }

    /**
     * Enables at least filtering for open count instead of filtering for the exact count
     *
     * Must be in conjunction with setActivityOpen
     *
     * @param mixed $flag
     * @return static
     */
    public function setActivityOpenMin($flag)
    {

        $this->setAttributeRaw('activity_open_min', $this->convertBool($flag));

        return $this;
    }

    /**
     * Enables at least filtering for click count instead of filtering for the exact count
     *
     * Must be in conjunction with setActivityClick
     *
     * @param mixed $flag
     * @return static
     */
    public function setActivityClickMin($flag)
    {

        $this->setAttributeRaw('activity_click_min', $this->convertBool($flag));

        return $this;
    }

    /**
     * Sets the status filter
     *
     * @param string|string[] $status Available values: queued, received, delivered, paused, bounced, abused, rejected, deleted
     * @return static
     */
    public function setStatus($status)
    {

        if (is_array($status)) {
            $status = implode(',', $status);
        }

        $this->setAttributeRaw('status', $status);

        return $this;
    }

    /**
     * Filter by one or more project ids
     *
     * Can contain multiple values in comma-separated list
     *
     * @param int|int[] $id
     * @return static
     */
    public function setProjectId($id)
    {

        if (is_array($id)) {
            $id = implode(',', $id);
        }

        $this->setAttributeRaw('project_id', $id);

        return $this;
    }

    /**
     * Sets the search query filter
     *
     * Has no effect when used in conjunction with any of these filters: from, to, subject, message
     *
     * @param string $search
     * @return static
     */
    public function setSearch($search)
    {
        $this->setAttributeRaw('search', $search);

        return $this;
    }

    /**
     * From name or email to filter list by
     *
     * Ignores search filter when set
     *
     * @param string $from
     * @return static
     */
    public function setFrom($from)
    {
        $this->setAttributeRaw('from', $from);

        return $this;
    }

    /**
     * To name or email to filter list by
     *
     * Ignores search filter when set
     *
     * @param string $to
     * @return static
     */
    public function setTo($to)
    {
        $this->setAttributeRaw('to', $to);

        return $this;
    }

    /**
     * Email subject to filter list by
     *
     * Ignores search filter when set
     *
     * @param string $subject
     * @return static
     */
    public function setSubject($subject)
    {
        $this->setAttributeRaw('subject', $subject);

        return $this;
    }

    /**
     * Message contents to filter list by
     *
     * Ignores search filter when set
     *
     * @param string $message
     * @return static
     */
    public function setMessage($message)
    {
        $this->setAttributeRaw('message', $message);

        return $this;
    }

}