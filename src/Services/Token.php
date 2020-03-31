<?php
namespace Lacasera\MazzumaApi\Services;

use Lacasera\MazzumaApi\Request\ApiRequest;

class Token
{

    /**
     * @var string
     */
    protected $apikey;

    /**
     * @var ApiRequest
     */
    protected $client;

    /**
     * Token constructor.
     * @param string $apiKey
     */
    public function __construct(string $apiKey)
    {
        $this->apikey = $apiKey;

        $this->client = new ApiRequest();
    }

    /**
     * @param array $payload
     * @return string
     */
    public function send(array $payload)
    {
        return $this->client->post('phase3/mazexchange-api.php', $this->buildPayload($payload));
    }

    /**
     * @param array $payload
     * @return mixed
     */
    public function receive(array $payload)
    {
        return $this->client->post('phase3/mazexchange-api.php', $this->buildPayload($payload));
    }

    /**
     * @param $hash
     * @return mixed
     */
    public function verify($hash)
    {
        return $this->client->get('checktransaction.php', [
            'hash' => $hash
        ]);
    }

    /**
     * @return mixed
     */
    public function getBalance()
    {
        return $this->client->post('phase3/mazexchange-api.php', $this->buildPayload([
            'option' => 'get_balance'
        ]));
    }

    /**
     * @param $payload
     * @return mixed
     */
    public function validate($payload)
    {
        return $this->client->post('phase3/mazexchange-api.php', $this->buildPayload($payload));
    }

    /**
     * @param array $payload
     * @return array
     */
    private function buildPayload(array $payload)
    {
        return array_merge($payload, ['apikey' => $this->apikey]);
    }
}