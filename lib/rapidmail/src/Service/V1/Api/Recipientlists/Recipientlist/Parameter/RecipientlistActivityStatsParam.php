<?php

namespace Rapidmail\ApiClient\Service\V1\Api\Recipientlists\Recipientlist\Parameter;

use Rapidmail\ApiClient\Service\Parameter\GenericParameter;

class RecipientlistActivityStatsParam extends GenericParameter
{

    /**
     * @inheritDoc
     */
    protected function getKnownAttributeKeys()
    {
        return [
            'from',
            'to'
        ];

    }

    /**
     * Sets the from date
     *
     * @param string|\DateTimeInterface $from
     * @return static
     */
    public function setFrom($from)
    {
        $this->setAttributeRaw('from', $this->stringifyDateTime($from, 'Y-m-d'));
        return $this;
    }

    /**
     * Sets the to date
     *
     * @param string|\DateTimeInterface $to
     * @return static
     */
    public function setTo($to)
    {
        $this->setAttributeRaw('to', $this->stringifyDateTime($to, 'Y-m-d'));
        return $this;
    }
}
