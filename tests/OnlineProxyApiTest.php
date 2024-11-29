<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use onOrg\OnlineProxyApi\OnlineProxyApi;

class OnlineProxyApiTest extends TestCase
{
    /**
     * @var OnlineProxyApi
     */
    private $apiClient;

    public function setUp(): void {
        $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__.'/..');
        try {
            $dotenv->load();
        } catch (\Exception $e) {}
        $this->apiClient = new OnlineProxyApi(getenv('ON_APIKEY'), 'en');
    }

    public function testGetProxyList()
    {
        $proxies = $this->apiClient->getProxyList();
        $this->assertIsObject($proxies);
        $this->assertIsArray($proxies->proxies, "'proxies' should be an array.");
    }

    public function testGetProxy()
    {
        $proxyList = $this->apiClient->getProxyList();
        $this->assertIsObject($proxyList);
        $proxyId = $proxyList->proxies[0]->id ?? null;
        $this->assertNotNull($proxyId, 'Proxy ID should not be null.');

        $proxy = $this->apiClient->getProxy($proxyId);
        $this->assertIsObject($proxy);
        $this->assertTrue(property_exists($proxy, 'id'), "'id' does not exist in the object.");
        $this->assertSame($proxy->id, $proxyId, 'Proxy ID should match.');
    }

    public function testGetUserBalance()
    {
        $balance = $this->apiClient->getUserBalance();
        $this->assertIsObject($balance);
        $this->assertTrue(property_exists($balance, 'balance'), "'balance' does not exist in the object.");
    }

    public function testGetAvailableProxiesForOrder()
    {
        $availableProxies = $this->apiClient->getAvailableProxiesForOrder();


        // Check that the response is an object
        $this->assertIsObject($availableProxies, 'The response is not an object.');

        // Check that the 'operators' property is not empty
        $this->assertNotEmpty($availableProxies->operators, "'operators' should not be empty.");

        // Check that the 'cities' property is not empty
        $this->assertNotEmpty($availableProxies->cities, "'cities' should not be empty.");

        // Check that the 'countries' property is not empty
        $this->assertNotEmpty($availableProxies->countries, "'countries' should not be empty.");
    }

    public function testGetProxyTariffs()
    {
        $tariffs = $this->apiClient->getProxyTariffs();
        $this->assertIsObject($tariffs);
        $this->assertIsArray($tariffs, "'proxies' should be an array.");
    }
}
