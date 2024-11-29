<?php


namespace onOrg\OnlineProxyApi;

use onOrg\OnlineProxyApi\Exceptions\RequestException;
use onOrg\OnlineProxyApi\Responses\AvailableProxies;
use onOrg\OnlineProxyApi\Responses\CommentResult;
use onOrg\OnlineProxyApi\Responses\GetProxyList;
use onOrg\OnlineProxyApi\Responses\OrderResult;
use onOrg\OnlineProxyApi\Responses\ProxyOne;
use onOrg\OnlineProxyApi\Responses\RotateResult;
use onOrg\OnlineProxyApi\Responses\Tariffs;
use onOrg\OnlineProxyApi\Responses\UserBalance;

class OnlineProxyApi
{
    protected $request;

    /**
     * OnlineProxyApi constructor.
     * @param string $apiKey
     * @param null|string $locale - null|ru|en
     * @param null|string $dev_id
     */
    public function __construct($apiKey, $locale = null, $dev_id = null) {
        $this->request = new Request($apiKey, $locale, $dev_id);
    }


    /**
     * Get a list of proxies.
     * @return GetProxyList
     * @throws RequestException
     */
    public function getProxyList() {
        $response = $this->request->send('proxies', [], 'GET');
        return new GetProxyList($response['proxies']);
    }

    /**
     * Get details of a specific proxy by ID.
     * @param string $id
     * @return ProxyOne
     * @throws RequestException
     */
    public function getProxy($id) {
        $response = $this->request->send("proxies/{$id}", [], 'GET');
        return new ProxyOne($response);
    }

    /**
     * Get user balance.
     * @return UserBalance
     * @throws RequestException
     */
    public function getUserBalance() {
        $response = $this->request->send('balance', [], 'GET');
        return new UserBalance($response);
    }

    /**
     * Rotate proxy IP address.
     * @return RotateResult
     * @throws RequestException
     */
    public function rotateProxy() {
        $response = $this->request->send('rotate', [], 'GET');
        return new RotateResult($response);
    }

    /**
     * Create or update a proxy comment.
     * @param string $id
     * @param string $comment
     * @return CommentResult
     * @throws RequestException
     */
    public function createOrUpdateProxyComment($id, $comment) {
        $response = $this->request->send("proxies/{$id}/comment", ['comment' => $comment], 'POST');
        return new CommentResult($response);
    }

    /**
     * Get available proxies for order.
     * @return AvailableProxies
     * @throws RequestException
     */
    public function getAvailableProxiesForOrder() {
        $response = $this->request->send('filters', [], 'GET');
        return new AvailableProxies($response['proxies']);
    }

    /**
     * Order a proxy.
     * @param array $orderData
     * @return OrderResult
     * @throws RequestException
     */
    public function orderProxy($orderData) {
        $response = $this->request->send('order', $orderData, 'POST');
        return new OrderResult($response);
    }

    /**
     * Get available proxy tariffs.
     * @return Tariffs
     * @throws RequestException
     */
    public function getProxyTariffs() {
        $response = $this->request->send('tariffs', [], 'GET');
        return new Tariffs($response['tariffs']);
    }

}
