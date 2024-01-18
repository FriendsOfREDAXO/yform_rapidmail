#!/bin/bash

BUILDDIR=$(dirname "$0")
cd "${BUILDDIR}/../"
rm -rf vendor/ apiv3-client-php.zip
composer install --no-dev
git archive --format=zip -o rapidmail-apiv3-client-php.zip HEAD \
&& zip -ur rapidmail-apiv3-client-php.zip vendor