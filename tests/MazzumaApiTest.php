<?php

namespace Lacasera\MazzumaApi\Tests;

use Lacasera\MazzumaApi\MazzumaApi;
use Lacasera\MazzumaApi\Services\{MobileMoney, Token};
use PHPUnit\Framework\TestCase;

class MazzumaApiTest extends TestCase
{

    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }

    /** @test */
    public function should_set_api_key()
    {
        $apiKey = "1233234234";

        $api = new MazzumaApi();

        $api->setApiKey($apiKey);

        $this->assertEquals($api->getApiKey(), $apiKey);
    }

    /**
     * @test
     * @param $service
     * @param $class
     * @dataProvider buildSupportedServices
     */
    public function it_should_return_instance_of_the_right_service($service, $class)
    {
        $api = new MazzumaApi();

        $expected = $api->setApiKey('1233234234')->setService($service);

        $this->assertInstanceOf($class, $expected);
    }

    public function buildSupportedServices()
    {
        return [
             ['mobile-money', MobileMoney::class],
             ['token', Token::class]
        ];
    }
}
