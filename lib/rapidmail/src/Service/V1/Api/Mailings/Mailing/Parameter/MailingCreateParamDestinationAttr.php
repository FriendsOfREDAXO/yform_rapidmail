<?php

namespace Rapidmail\ApiClient\Service\V1\Api\Mailings\Mailing\Parameter;

use Rapidmail\ApiClient\Exception\InvalidArgumentException;
use Rapidmail\ApiClient\Service\Parameter\GenericParameter;

class MailingCreateParamDestinationAttr extends GenericParameter
{

    /**
     * @var string[]
     */
    const ALLOWED_TYPES = [
        'recipientlist'
    ];

    /**
     * @var string[]
     */
    const ALLOWED_ACTIONS = [
        'include',
        'exclude'
    ];

    /**
     * Constructor
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {

        parent::__construct(
            array_replace(
                [
                    'type' => 'recipientlist',
                    'action' => 'include'
                ],
                $attributes
            )
        );

    }

    /**
     * @inheritDoc
     */
    protected function getKnownAttributeKeys()
    {
        return [
            'id',
            'type',
            'action'
        ];
    }

    /**
     * Sets the destination ID
     *
     * @return static
     * @var int $destinationId
     */
    public function setId($destinationId)
    {

        if (!is_numeric($destinationId)) {
            throw new InvalidArgumentException('Destination ID must be numeric');
        }

        $this->setAttributeRaw('id', $destinationId);

        return $this;
    }

    /**
     * Sets the destination type
     *
     * @return static
     * @var string $type
     */
    public function setType($type)
    {

        if (!in_array($type, static::ALLOWED_TYPES)) {

            throw new InvalidArgumentException(
                'Destination type not allowed. Must be one of: ' . implode(', ', static::ALLOWED_TYPES)
            );

        }
        $this->setAttributeRaw('type', $type);

        return $this;
    }

    /**
     * Sets the destination action
     *
     * @return static
     * @var string $action
     */
    public function setAction($action)
    {

        if (!in_array($action, static::ALLOWED_ACTIONS)) {

            throw new InvalidArgumentException(
                'Destination action not allowed. Must be one of: ' . implode(', ', static::ALLOWED_ACTIONS)
            );

        }
        $this->setAttributeRaw('action', $action);

        return $this;
    }

}
