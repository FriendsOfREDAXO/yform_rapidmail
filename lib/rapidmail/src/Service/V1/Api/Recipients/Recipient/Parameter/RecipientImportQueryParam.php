<?php

namespace Rapidmail\ApiClient\Service\V1\Api\Recipients\Recipient\Parameter;

use Rapidmail\ApiClient\Exception\InvalidArgumentException;
use Rapidmail\ApiClient\Service\Parameter\GenericParameter;

class RecipientImportQueryParam extends GenericParameter
{

    /**
     * @var string[]
     */
    const RECIPIENT_EXISTS_HANDLING = [
        'stock',
        'importfile'
    ];

    /**
     * @var string[]
     */
    const RECIPIENT_MISSING_HANDLING = [
        'nothing',
        'delete',
        'softdelete'
    ];

    /**
     * @var string[]
     */
    const RECIPIENT_DELETED_HANDLING = [
        'nothing',
        'import'
    ];

    /**
     * @inheritDoc
     */
    protected function getKnownAttributeKeys()
    {
        return [
            'delimiter',
            'enclosure',
            'recipient_exists',
            'recipient_missing',
            'recipient_deleted'
        ];
    }

    /**
     * Sets the field delimiter character. Defaults to ;
     *
     * @param string $delimiter
     * @return static
     */
    public function setDelimiter($delimiter)
    {
        $this->setAttributeRaw('delimiter', $delimiter);

        return $this;
    }

    /**
     * Sets the enclosure character. Defaults to "
     *
     * @param string $enclosure
     * @return static
     */
    public function setEnclosure($enclosure)
    {
        $this->setAttributeRaw('enclosure', $enclosure);

        return $this;
    }

    /**
     * Specify handling for recipients that already exist
     *
     * @param string $mode
     * @return static
     */
    public function setRecipientExists($mode)
    {

        if (!in_array($mode, static::RECIPIENT_EXISTS_HANDLING)) {

            throw new InvalidArgumentException(
                'Invalid mode provided. Must be one of: ' . implode(', ', static::RECIPIENT_EXISTS_HANDLING)
            );

        }
        $this->setAttributeRaw('recipient_exists', $mode);

        return $this;
    }

    /**
     * Specify handling for recipients that do not yet exist
     *
     * @param string $mode
     * @return static
     */
    public function setRecipientMissing($mode)
    {

        if (!in_array($mode, static::RECIPIENT_MISSING_HANDLING)) {

            throw new InvalidArgumentException(
                'Invalid mode provided. Must be one of: ' . implode(', ', static::RECIPIENT_MISSING_HANDLING)
            );

        }
        $this->setAttributeRaw('recipient_missing', $mode);

        return $this;
    }

    /**
     * Specify handling for recipients that have been marked as deleted
     *
     * @param string $mode
     * @return static
     */
    public function setRecipientDeleted($mode)
    {

        if (!in_array($mode, static::RECIPIENT_DELETED_HANDLING)) {

            throw new InvalidArgumentException(
                'Invalid mode provided. Must be one of: ' . implode(', ', static::RECIPIENT_DELETED_HANDLING)
            );

        }
        $this->setAttributeRaw('recipient_deleted', $mode);

        return $this;
    }

}