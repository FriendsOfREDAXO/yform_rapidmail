<?php

namespace Rapidmail\ApiClient\Service\V1\Api\ApiUsers\ApiUser\Parameter;

use Rapidmail\ApiClient\Service\Parameter\GenericParameter;

class ApiUserCreateParam extends GenericParameter
{

    /**
     * @inheritDoc
     */
    protected function getKnownAttributeKeys()
    {
        return [
            'description',
            'authentication_type'
        ];
    }

    /**
     * ApiUser description (required)
     *
     * @param string $description
     * @return static
     */
    public function setDescription($description)
    {
        $this->setAttributeRaw('description', $description);

        return $this;
    }

    /**
     * Authentication type used for API user
     *
     * Please note that setting authentication_type to “key” will currently only result
     * in a usable user if a default authentication key has been configured for the whitelabel.
     *
     * @param string $authenticationType Available: password, key
     * @return static
     */
    public function setAuthenticationType($authenticationType)
    {
        $this->setAttributeRaw('authentication_type', $authenticationType);

        return $this;
    }

}
