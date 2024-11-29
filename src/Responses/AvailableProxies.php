<?php

namespace onOrg\OnlineProxyApi\Responses;

class AvailableProxies extends Base
{
    public $proxies = [];

    public function __construct($properties = []) {
        foreach ($properties as $proxy) {
            $this->proxies[] = new ProxyOne($proxy);
        }
    }

    /**
     * Get the first available proxy.
     * @return ProxyOne|null
     */
    public function first() {
        return $this->proxies[0] ?? null;
    }

    /**
     * Convert available proxies to an array.
     * @return array
     */
    public function toArray() {
        return array_map(function ($proxy) {
            return $proxy->toArray();
        }, $this->proxies);
    }
}
