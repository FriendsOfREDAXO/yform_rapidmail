<?php

namespace Rapidmail\ApiClient\Service\V1\Api\Mailings\Mailing\Parameter;

use Rapidmail\ApiClient\Service\Parameter\GenericParameter;

/**
 * Parameter factory
 */
class ParameterFactory
{

    /**
     * Creates a new generic parameter
     *
     * @param array $input
     * @return GenericParameter
     */
    public function newGenericParameter(array $input = [])
    {
        return new GenericParameter($input);
    }

    /**
     * Creates a new query parameter
     *
     * @param array $input
     * @return MailingQueryParam
     */
    public function newQueryParam(array $input = [])
    {
        return new MailingQueryParam($input);
    }

    /**
     * Creates a new create parameter
     *
     * @param array $input
     * @return MailingCreateParam
     */
    public function newCreateParam(array $input = [])
    {
        return new MailingCreateParam($this, $input);
    }

    /**
     * Creates a file attribute for use within the create parameter
     *
     * @param array $input
     * @return MailingCreateParamFileAttr
     */
    public function newMailingCreateParamFileAttr(array $input = [])
    {
        return new MailingCreateParamFileAttr($input);
    }

    /**
     * Creates a destination attribute for use within the create parameter
     *
     * @param array $input
     * @return MailingCreateParamDestinationAttr
     */
    public function newMailingCreateParamDestinationAttr(array $input = [])
    {
        return new MailingCreateParamDestinationAttr($input);
    }

}
