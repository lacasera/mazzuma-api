<?php
namespace Lacasera\MazzumaApi\Services;

use Lacasera\MazzumaApi\Request\ApiRequest;

class MobileMoney
{
    protected $apiKey;

    protected $client;

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;

        $this->client = new ApiRequest;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function pay(array $data)
    {
        return $this->client->post("api_call.php", array_merge($data, ['apiKey' => $this->apiKey]));
    }

    /**
     * @param $orderId
     * @return mixed
     */
    public function verify($orderId)
    {
        return $this->client->get("checktransaction.php", [
            'orderID' => $orderId
        ]);
    }
}