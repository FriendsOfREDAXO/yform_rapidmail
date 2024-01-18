<?php

namespace Rapidmail\ApiClient\Util;

use Rapidmail\ApiClient\Exception\IncompatiblePlatformException;

class PlatformRequirements
{

    /**
     * @var string
     */
    const MIN_PHP_VERSION = "5.6.0";

    /**
     * @var string[]
     */
    const REQUIRED_EXTENSIONS = [
        'json',
        'fileinfo'
    ];

    /**
     * Assert platform requirements are met
     *
     * @throws IncompatiblePlatformException
     */
    public function assertPlatformRequirements()
    {

        $version = static::MIN_PHP_VERSION;

        if (!(bool)version_compare(PHP_VERSION, $version, ">=")) {

            throw new IncompatiblePlatformException(
                "Minimum version of PHP required is {$version}"
            );

        }

        foreach (static::REQUIRED_EXTENSIONS as $extension) {

            if (!extension_loaded($extension)) {

                throw new IncompatiblePlatformException(
                    "Required PHP extension {$extension} is not loaded"
                );

            }

        }

    }

}
