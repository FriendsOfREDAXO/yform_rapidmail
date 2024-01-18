<?php

namespace Rapidmail\ApiClient\Service\V1\Api\Recipients\Recipient\Parameter;

use Rapidmail\ApiClient\Service\Parameter\GenericParameter;

class RecipientDeleteQueryParam extends GenericParameter
{

    /**
     * @inheritDoc
     */
    protected function getKnownAttributeKeys()
    {
        return [
            'track_unsubscription'
        ];
    }

    /**
     * If enabled, unsubscription will be tracked in stats. Defaults to yes.
     *
     * @param mixed $flag
     * @return static
     */
    public function setTrackUnsubscription($flag)
    {
        $this->setAttributeRaw('track_unsubscription', $this->convertBool($flag));

        return $this;
    }

}