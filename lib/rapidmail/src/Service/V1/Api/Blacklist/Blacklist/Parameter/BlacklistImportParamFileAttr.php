<?php

namespace Rapidmail\ApiClient\Service\V1\Api\Blacklist\Blacklist\Parameter;

use Rapidmail\ApiClient\Service\Parameter\FileAttr;

class BlacklistImportParamFileAttr extends FileAttr
{

    /**
     * @var string[]
     */
    const ALLOWED_MIME_TYPES = [
        'text/plain',
        'text/csv'
    ];

}
