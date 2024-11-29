<?php

namespace onOrg\OnlineProxyApi\Responses;

class Tariffs extends Base
{
    public $tariffs = [];

    public function __construct($properties = []) {
        foreach ($properties as $tariff) {
            $this->tariffs[] = new Tariff($tariff);
        }
    }

    /**
     * Get the first available Tariff.
     * @return Tariff|null
     */
    public function first() {
        return $this->proxies[0] ?? null;
    }


    /**
     * Convert tariffs to an array.
     * @return array
     */
    public function toArray() {
        return array_map(function ($tariff) {
            return $tariff->toArray();
        }, $this->tariffs);
    }
}
