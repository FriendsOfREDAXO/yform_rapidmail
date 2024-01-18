<?php

namespace Rapidmail\ApiClient\Service\V1\Api\Blacklist\Blacklist\Parameter;

use Rapidmail\ApiClient\Service\Parameter\GenericParameter;

class BlacklistCreateParam extends GenericParameter
{

    /**
     * @inheritDoc
     */
    protected function getKnownAttributeKeys()
    {

        return [
            'pattern'
        ];

    }

    /**
     * Sets the pattern to match against when blacklisting
     *
     * Type will be auto-detected based on given pattern structure.
     *
     * @param string $pattern
     * @return static
     */
    public function setPattern($pattern)
    {
        $this->setAttributeRaw('pattern', $pattern);

        return $this;
    }

}