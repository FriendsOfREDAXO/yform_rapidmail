#!/bin/bash
set -e
docker run -it --rm --name="phpunit" -w /app -v "$PWD":/app php:"$1"-cli /app/vendor/bin/phpunit
