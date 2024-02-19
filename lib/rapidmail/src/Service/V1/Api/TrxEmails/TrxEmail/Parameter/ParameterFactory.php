<?php

namespace Rapidmail\ApiClient\Service\V1\Api\TrxEmails\TrxEmail\Parameter;

class ParameterFactory
{

    /**
     * Creates a new transaction emails query parameter
     *
     * @param array $input
     * @return TrxEmailQueryParam
     */
    public function newQueryParam(array $input = [])
    {
        return new TrxEmailQueryParam($input);
    }

}
