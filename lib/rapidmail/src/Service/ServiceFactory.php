<?php

namespace Rapidmail\ApiClient\Service;

use Rapidmail\ApiClient\Exception\NotImplementedException;
use Rapidmail\ApiClient\Http\HttpClientFactory;
use Rapidmail\ApiClient\Http\HttpClientInterface;
use Rapidmail\ApiClient\Service\Response\ResponseFactory;

class ServiceFactory
{

    /**
     * @var array
     */
    private $userConfig;

    /**
     * @var HttpClientFactory
     */
    private $httpClientFactory;

    /**
     * Constructor
     *
     * @param HttpClientFactory $httpClientFactory
     * @param array $config
     */
    public function __construct(HttpClientFactory $httpClientFactory, array $config = [])
    {
        $this->httpClientFactory = $httpClientFactory;
        $this->userConfig = $config;
    }

    /**
     * @return array
     */
    private function getGlobalConfig()
    {
        return require __DIR__ . '/../Config/services.php';
    }

    /**
     * Create a specific API service
     *
     * @param string $service
     * @param string|null $version
     * @return \Rapidmail\ApiClient\Service\ServiceInterface
     * @throws NotImplementedException
     */
    public function createService($service, $version = null)
    {

        $globalConfig = $this->getGlobalConfig();

        if (!isset($globalConfig['services'][$service])) {
            throw new NotImplementedException("API service '{$service}' not found");
        }

        if ($version === null) {
            $version = $globalConfig['services'][$service]['current'];
        }

        if (!isset($globalConfig['services'][$service]['config'][$version])) {
            throw new NotImplementedException("API service '{$service}' for version '{$version}' not found");
        }

        $connectionSettings = array_replace_recursive(
            $globalConfig['connection'],
            ['version' => $version],
            $this->userConfig
        );

        $factoryClass = $globalConfig['services'][$service]['config'][$version]['factory_class'];
        $interfaces = class_implements($factoryClass);

        if ($interfaces === false || in_array(ServiceFactoryInterface::class, $interfaces) === false) {
            throw new NotImplementedException("Service factory {$factoryClass} must implement ServiceFactoryInterface");
        }

        /** @var ServiceFactoryInterface $factory */
        $factory = new $factoryClass();

        return $factory->create(
            [
                HttpClientInterface::class => $this->httpClientFactory->createClient($connectionSettings),
                ResponseFactory::class => new ResponseFactory()
            ]
        );

    }

}
