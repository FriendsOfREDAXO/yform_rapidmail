<?php

namespace Rapidmail\ApiClient\Service\V1\Api\Mailings\Mailing\Parameter;

use Rapidmail\ApiClient\Service\Parameter\FileAttr;

class MailingCreateParamFileAttr extends FileAttr
{

    /**
     * @var string[]
     */
    const ALLOWED_MIME_TYPES = [
        'application/zip',
        'application/x-zip-compressed'
    ];

}
