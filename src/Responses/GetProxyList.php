<?php

namespace onOrg\OnlineProxyApi\Responses;

class GetProxyList extends Base
{
    public $proxies = [];

    public function __construct($properties = []) {
        foreach ($properties as $proxy) {
            $this->proxies[] = new ProxyOne($proxy);
        }
    }

    /**
     * Get the first proxy in the list.
     * @return ProxyOne|null
     */
    public function first() {
        return $this->proxies[0] ?? null;
    }

    /**
     * Convert the list of proxies to an array.
     * @return array
     */
    public function toArray() {
        return array_map(function ($proxy) {
            return $proxy->toArray();
        }, $this->proxies);
    }
}
