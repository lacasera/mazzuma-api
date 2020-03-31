<?php
namespace Lacasera\MazzumaApi\Request;

use Lacasera\MazzumaApi\Contracts\CurlInterface;

class ApiRequest implements CurlInterface
{
    protected $curl;

    protected $baseUrl = "https://client.teamcyst.com";


    /**
     * ApiRequest constructor.
     */
    public function __construct()
    {
        $this->curl = curl_init();
    }

    /**
     * @param $uri
     * @param $data
     * @param array $headers
     * @return mixed
     */
    public function post($uri, $data, $headers = [])
    {
        $this->attachPostOptions($uri, $data, $headers);

        return $this->makeCall();
    }

    /**
     * @param $uri
     * @param array $params
     * @param array $headers
     * @return mixed
     */
    public function get($uri, $params = [], $headers = [])
    {
        $this->attachGetOptions($uri, $params, $headers);

        return $this->makeCall();
    }


    /**
     * @return mixed
     */
    protected function makeCall()
    {
        $response = curl_exec($this->curl);

        curl_close($this->curl);

        return $response;
    }

    /**
     * @param $uri
     * @param $data
     * @param $headers
     * @return array
     */
    protected function attachPostOptions($uri, $data, $headers = [])
    {
        curl_setopt_array($this->curl, array(
            CURLOPT_URL => "{$this->baseUrl}/{$uri}",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array_merge([
                "Content-Type: application/json"
            ], $headers)
        ));
    }

    /**
     * @param $uri
     * @param $data
     * @param $headers
     */
    protected function attachGetOptions($uri, $data, $headers = [])
    {
        $endpoint = !empty($data) ?  $uri ."?".http_build_query($data) : '';

        curl_setopt_array($this->curl, [
            CURLOPT_URL => $this->baseUrl. '/'. $endpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array_merge([
                "Content-Type: application/json"
            ], $headers)
        ]);
    }
}