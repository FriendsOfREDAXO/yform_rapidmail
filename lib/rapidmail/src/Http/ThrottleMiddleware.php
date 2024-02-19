<?php

namespace Rapidmail\ApiClient\Http;

use Psr\Http\Message\RequestInterface;

/**
 * Guzzle client throttle middleware
 */
class ThrottleMiddleware
{

    /**
     *  Singleton instance
     *
     * @var static
     */
    private static $instance;

    /**
     * Interval in seconds
     *
     * @var float
     */
    private $interval;

    /**
     * Number of requests per interval
     *
     * @var int
     */
    private $requestsPerInterval;

    /**
     * @var int[]
     */
    private $timestampStack = [];

    /**
     * Constructor
     *
     * @param float $interval Interval in seconds
     * @param int $requestsPerInterval
     */
    private function __construct($interval, $requestsPerInterval)
    {

        $this->interval = $interval;
        $this->requestsPerInterval = $requestsPerInterval;
    }

    /**
     * Get a global instance
     *
     * @param float $interval Interval in seconds
     * @param int $requestsPerInterval
     * @return static
     */
    public static function getInstance($interval, $requestsPerInterval)
    {

        if (static::$instance === null) {
            static::$instance = new static($interval, $requestsPerInterval);
        }

        return static::$instance;
    }

    /**
     * Create the throttle middleware
     *
     * @param callable $handler
     * @return callable
     */
    public function __invoke(callable $handler)
    {

        return function (RequestInterface $request, array $options) use ($handler) {
            $this->throttle();

            return $handler($request, $options);
        };

    }

    /**
     * Apply throttling when requests per interval being exceeded
     */
    private function throttle()
    {

        $now = microtime(true);

        // Expire outdated

        $this->timestampStack = array_values(
            array_filter(
                $this->timestampStack,
                function ($last) use ($now) {
                    return $now - $last < $this->interval;
                }
            )
        );

        // Sleep at least until oldest timestamp expires

        if (count($this->timestampStack) >= $this->requestsPerInterval) {

            usleep(
                (int) abs(
                    min($now - $this->timestampStack[0] - $this->interval, 0)
                ) * 1000000
            );

        }

        $this->timestampStack[] = microtime(true);

    }

}
