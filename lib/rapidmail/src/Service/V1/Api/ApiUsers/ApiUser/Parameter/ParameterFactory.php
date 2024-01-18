<?php

namespace Rapidmail\ApiClient\Service\V1\Api\ApiUsers\ApiUser\Parameter;

class ParameterFactory
{

    /**
     * Creates a new query parameter
     *
     * @param array $input
     * @return ApiUserQueryParam
     */
    public function newQueryParam(array $input = [])
    {
        return new ApiUserQueryParam($input);
    }

    /**
     * Creates a new create parameter
     *
     * @param array $input
     * @return ApiUserCreateParam
     */
    public function newCreateParam(array $input = [])
    {
        return new ApiUserCreateParam($input);
    }

}