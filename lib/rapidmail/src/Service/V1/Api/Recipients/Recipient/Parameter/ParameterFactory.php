<?php

namespace Rapidmail\ApiClient\Service\V1\Api\Recipients\Recipient\Parameter;

class ParameterFactory
{

    /**
     * Creates a new query parameter
     *
     * @param array $input
     * @return RecipientQueryParam
     */
    public function newQueryParam(array $input = [])
    {
        return new RecipientQueryParam($input);
    }

    /**
     * Creates a new create parameter
     *
     * @param array $input
     * @return RecipientCreateParam
     */
    public function newCreateParam(array $input = [])
    {
        return new RecipientCreateParam($input);
    }

    /**
     * Creates a new create query parameter
     *
     * @param array $input
     * @return RecipientCreateQueryParam
     */
    public function newCreateQueryParam(array $input = [])
    {
        return new RecipientCreateQueryParam($input);
    }

    /**
     * Creates a new delete query parameter
     *
     * @param array $input
     * @return RecipientDeleteQueryParam
     */
    public function newDeleteQueryParam(array $input = [])
    {
        return new RecipientDeleteQueryParam($input);
    }

    /**
     * Creates a new import parameter
     *
     * @param array $input
     * @return RecipientImportParam
     */
    public function newImportParam(array $input = [])
    {
        return new RecipientImportParam($this, $input);
    }

    /**
     * Creates a new import query parameter
     *
     * @param array $input
     * @return RecipientImportQueryParam
     */
    public function newImportQueryParam(array $input = [])
    {
        return new RecipientImportQueryParam($input);
    }

    /**
     * Creates a new import parameter file attribute
     *
     * @param array $input
     * @return RecipientImportParamFileAttr
     */
    public function newImportParamFileAttr(array $input = [])
    {
        return new RecipientImportParamFileAttr($input);
    }

}
