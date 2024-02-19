<?php

namespace Rapidmail\ApiClient\Service\V1\Api\Recipientlists\Recipientlist\Parameter;

/**
 * Parameter factory
 */
class ParameterFactory
{

    /**
     * Creates a new recipientlists create parameter
     *
     * @param array $input
     * @return RecipientlistCreateParam
     */
    public function newCreateParam(array $input = [])
    {
        return new RecipientlistCreateParam($input);
    }

    /**
     * Creates a new recipientlists activity stats parameter
     *
     * @param array $input
     * @return RecipientlistActivityStatsParam
     */
    public function newActivityStatsParam(array $input = [])
    {
        return new RecipientlistActivityStatsParam($input);
    }
}
