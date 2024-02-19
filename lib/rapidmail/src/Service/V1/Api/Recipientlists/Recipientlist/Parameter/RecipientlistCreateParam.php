<?php

namespace Rapidmail\ApiClient\Service\V1\Api\Recipientlists\Recipientlist\Parameter;

use Rapidmail\ApiClient\Service\Parameter\GenericParameter;

class RecipientlistCreateParam extends GenericParameter
{

    /**
     * @inheritDoc
     */
    protected function getKnownAttributeKeys()
    {
        return [
            'name',
            'default',
            'unsubscribe_blacklist',
            'recipient_subscribe_email'
        ];
    }

    /**
     * Set recipientlist name (required)
     *
     * @param string $name
     * @return static
     */
    public function setName($name)
    {
        $this->setAttributeRaw('name', $name);

        return $this;
    }

    /**
     * Set recipientlist as default
     *
     * @param mixed $flag
     * @return static
     */
    public function setDefault($flag)
    {
        $this->setAttributeRaw('default', $this->convertBool($flag));

        return $this;
    }

    /**
     * Specify if recipients should be blacklisted upon unsubscription
     *
     * @param mixed $flag
     * @return static
     */
    public function setUnsubscribeBlacklist($flag)
    {
        $this->setAttributeRaw('unsubscribe_blacklist', $this->convertBool($flag));

        return $this;
    }

    /**
     * Specify if a welcome email should be sent on subscribe
     *
     * @param mixed $flag
     * @return static
     */
    public function setRecipientSubscribeEmail($flag)
    {
        $this->setAttributeRaw('recipient_subscribe_email', $this->convertBool($flag));

        return $this;
    }

}
