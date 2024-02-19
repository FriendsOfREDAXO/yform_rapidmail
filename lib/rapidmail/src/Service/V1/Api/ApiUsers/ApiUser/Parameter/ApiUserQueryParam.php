<?php

namespace Rapidmail\ApiClient\Service\V1\Api\ApiUsers\ApiUser\Parameter;

use Rapidmail\ApiClient\Service\Parameter\GenericParameter;

class ApiUserQueryParam extends GenericParameter
{

    /**
     * @inheritDoc
     */
    protected function getKnownAttributeKeys()
    {

        return [
            'page'
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

}
