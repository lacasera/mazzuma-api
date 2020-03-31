<?php

namespace Lacasera\MazzumaApi;

use Lacasera\MazzumaApi\Exceptions\{
    InvalidServiceException
};

class MazzumaApi
{
    /**
     * Mazzuma Api Key
     * @var string
     */
    protected $apiKey = "";

    /**
     * Mazzuma Service
     * @var string
     */
    protected $service = "";

    /**
     * @param $service
     * @return MazzumaApi
     * @throws InvalidServiceException
     */
    public function setService($service)
    {
        $this->service = $service;

        return $this->getBuildService();
    }

    /**
     * @param $key
     * @return MazzumaApi
     */
    public function setApiKey($key): self 
    {
        $this->apiKey = $key;
        
        return $this;
    }


    /**
     * @return string
     */
    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    /**
     * @return mixed
     * @throws InvalidServiceException
     */
    protected function getBuildService()
    {

        $serviceClass = __NAMESPACE__ . '\\Services\\' . $this->studlyCase($this->service);

        if (!class_exists($serviceClass)) {
            throw new InvalidServiceException("$serviceClass is not a valid Mazzuma Service");
        }

        return new $serviceClass($this->apiKey);
    }

    private function studlyCase($string)
    {
        return ucfirst(
            str_replace(
                " ",
                "",
                ucwords(
                    str_replace('-', ' ', $string)
                )
            )
        );
    }
}
