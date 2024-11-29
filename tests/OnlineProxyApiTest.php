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
        $this->assertObjectHasAttribute('proxies', $proxies);
    }

    public function testGetProxy()
    {
        $proxyList = $this->apiClient->getProxyList();
        $this->assertIsObject($proxyList);
        $proxyId = $proxyList->proxies[0]->id ?? null;
        $this->assertNotNull($proxyId, 'Proxy ID should not be null.');

        $proxy = $this->apiClient->getProxy($proxyId);
        $this->assertIsObject($proxy);
        $this->assertObjectHasAttribute('id', $proxy);
        $this->assertSame($proxy->id, $proxyId, 'Proxy ID should match.');
    }

    public function testGetUserBalance()
    {
        $balance = $this->apiClient->getUserBalance();
        $this->assertIsObject($balance);
        $this->assertObjectHasAttribute('balance', $balance);
    }

    public function testRotateProxy()
    {
        $rotationResult = $this->apiClient->rotateProxy();
        $this->assertIsObject($rotationResult);
        $this->assertObjectHasAttribute('success', $rotationResult);
        $this->assertTrue($rotationResult->success, 'Rotation should be successful.');
    }

    public function testCreateOrUpdateProxyComment()
    {
        $proxyList = $this->apiClient->getProxyList();
        $proxyId = $proxyList->proxies[0]->id ?? null;
        $this->assertNotNull($proxyId, 'Proxy ID should not be null.');

        $comment = 'Test comment';
        $commentResult = $this->apiClient->createOrUpdateProxyComment($proxyId, $comment);
        $this->assertIsObject($commentResult);
        $this->assertObjectHasAttribute('success', $commentResult);
        $this->assertTrue($commentResult->success, 'Comment update should be successful.');
    }

    public function testGetAvailableProxiesForOrder()
    {
        $availableProxies = $this->apiClient->getAvailableProxiesForOrder();
        $this->assertIsObject($availableProxies);
        $this->assertObjectHasAttribute('proxies', $availableProxies);
    }

    public function testOrderProxy()
    {
        $orderData = [
            'proxyType' => 'HTTP',
            'quantity' => 1,
            'location' => 'USA',
        ];
        $orderResult = $this->apiClient->orderProxy($orderData);
        $this->assertIsObject($orderResult);
        $this->assertObjectHasAttribute('success', $orderResult);
        $this->assertTrue($orderResult->success, 'Proxy order should be successful.');
    }

    public function testGetProxyTariffs()
    {
        $tariffs = $this->apiClient->getProxyTariffs();
        $this->assertIsObject($tariffs);
        $this->assertObjectHasAttribute('tariffs', $tariffs);
    }
}
