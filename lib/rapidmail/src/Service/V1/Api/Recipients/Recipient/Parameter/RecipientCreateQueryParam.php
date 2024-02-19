<?php

namespace Rapidmail\ApiClient\Service\V1\Api\Recipients\Recipient\Parameter;

use Rapidmail\ApiClient\Service\Parameter\GenericParameter;

class RecipientCreateQueryParam extends GenericParameter
{

    /**
     * @inheritDoc
     */
    protected function getKnownAttributeKeys()
    {

        return [
            'track_stats',
            'send_activationmail',
            'get_extra_big_fields'
        ];

    }

    /**
     * Sets if stats will be tracked for recipient. Default is no
     *
     * @param mixed $flag
     * @return static
     */
    public function setTrackStats($flag)
    {
        $this->setAttributeRaw('track_stats', $this->convertBool($flag));

        return $this;
    }

    /**
     * Sets if an activationmail will be sent
     *
     * Note that this applies only for recipients with status “new” and is ignored for all other recipient statuses.
     * Activation mails are never sent for demo accounts.
     *
     * @param mixed $flag
     * @return static
     */
    public function setSendActivationmail($flag)
    {
        $this->setAttributeRaw('send_activationmail', $this->convertBool($flag));

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
