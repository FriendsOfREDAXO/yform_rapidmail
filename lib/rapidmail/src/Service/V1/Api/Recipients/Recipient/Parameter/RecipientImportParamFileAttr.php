<?php

namespace Rapidmail\ApiClient\Service\V1\Api\Recipients\Recipient\Parameter;

use Rapidmail\ApiClient\Service\Parameter\FileAttr;

class RecipientImportParamFileAttr extends FileAttr
{

    /**
     * @var string[]
     */
    const ALLOWED_MIME_TYPES = [
        'text/plain',
        'text/csv',
        'application/zip',
        'application/x-zip-compressed'
    ];

}
