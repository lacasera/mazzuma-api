<?php
namespace Lacasera\MazzumaApi\Contracts;

interface CurlInterface
{
    /**
     * @param $uri
     * @param $data
     * @param array $headers
     * @return mixed
     */
    public function post($uri, $data, $headers = []);

    /**
     * @param $url
     * @param array $params
     * @param array $headers
     * @return mixed
     */
    public function get($url, $params = [], $headers = []);
}