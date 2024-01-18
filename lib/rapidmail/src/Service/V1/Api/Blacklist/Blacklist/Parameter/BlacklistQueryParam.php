<?php

namespace Rapidmail\ApiClient\Service\V1\Api\Blacklist\Blacklist\Parameter;

use Rapidmail\ApiClient\Service\Parameter\GenericParameter;

class BlacklistQueryParam extends GenericParameter
{

    protected function getKnownAttributeKeys()
    {
        return [
            'page',
            'pattern'
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
     * Filter pattern types (email/domain/regex) by pattern
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