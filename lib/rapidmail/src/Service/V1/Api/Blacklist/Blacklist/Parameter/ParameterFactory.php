<?php

namespace Rapidmail\ApiClient\Service\V1\Api\Blacklist\Blacklist\Parameter;

class ParameterFactory
{

    /**
     * Creates a new query parameter
     *
     * @param array $input
     * @return BlacklistQueryParam
     */
    public function newQueryParam(array $input = [])
    {
        return new BlacklistQueryParam($input);
    }

    /**
     * Creates a new create parameter
     *
     * @param array $input
     * @return BlacklistCreateParam
     */
    public function newCreateParam(array $input = [])
    {
        return new BlacklistCreateParam($input);
    }
    /**
     * Creates a new import query parameter
     *
     * @param array $input
     * @return BlacklistImportParam
     */
    public function newImportParam(array $input = [])
    {
        return new BlacklistImportParam($this, $input);
    }

    /**
     * Creates a new import parameter file attribute
     *
     * @param array $input
     * @return BlacklistImportParamFileAttr
     */
    public function newImportParamFileAttr(array $input = [])
    {
        return new BlacklistImportParamFileAttr($input);
    }
}
