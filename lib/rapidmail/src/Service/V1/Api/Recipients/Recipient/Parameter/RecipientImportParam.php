<?php

namespace Rapidmail\ApiClient\Service\V1\Api\Recipients\Recipient\Parameter;

use Rapidmail\ApiClient\Exception\InvalidArgumentException;
use Rapidmail\ApiClient\Service\Parameter\GenericParameter;

class RecipientImportParam extends GenericParameter
{

    /**
     * @var ParameterFactory
     */
    protected $parameterFactory;

    /**
     * Constructor
     *
     * @param ParameterFactory $parameterFactory
     * @param array $attributes
     */
    public function __construct(ParameterFactory $parameterFactory, array $attributes = [])
    {
        $this->parameterFactory = $parameterFactory;
        parent::__construct($attributes);
    }

    /**
     * @inheritDoc
     */
    protected function getKnownAttributeKeys()
    {
        return [
            'recipientlist_id',
            'file'
        ];
    }

    /**
     * Sets the file containing all recipients
     *
     * @param RecipientImportParamFileAttr|array|string|\SplFileInfo $file
     * @return static
     */
    public function setFile($file)
    {

        if ($file instanceof RecipientImportParamFileAttr) {
            $this->setAttributeRaw('file', $file);

            return $this;
        }

        if (is_array($file)) {
            $this->setAttributeRaw('file', $this->parameterFactory->newImportParamFileAttr($file));

            return $this;
        }

        $info = new \finfo(FILEINFO_MIME_TYPE);

        if ($file instanceof \SplFileInfo || is_file($file)) {

            if (!is_readable($file)) {
                throw new InvalidArgumentException("File {$file} is not readable");
            }

            $fileAttr = $this->parameterFactory->newImportParamFileAttr([
                'content' => base64_encode(file_get_contents($file)),
                'type' => $info->file($file)
            ]);

            $this->setAttributeRaw('file', $fileAttr);

            return $this;

        }

        throw new InvalidArgumentException("{$file} does not appear to be a valid file");

    }

}