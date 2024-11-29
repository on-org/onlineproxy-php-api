<?php

namespace onOrg\OnlineProxyApi\Responses;

class AvailableProxies extends Base
{
    public $countries = [];
    public $regions = [];
    public $cities = [];
    public $operators = [];

    public function __construct(array $properties = []) {
        if (isset($properties['geo_country'])) {
            $this->countries = $properties['geo_country'];
        }
        if (isset($properties['geo_region'])) {
            $this->regions = $properties['geo_region'];
        }
        if (isset($properties['geo_city'])) {
            $this->cities = array_map(function ($city) {
                return new GeoCity($city);
            }, $properties['geo_city']);
        }
        if (isset($properties['geo_operator'])) {
            $this->operators = array_map(function ($operator) {
                return new GeoOperator($operator);
            }, $properties['geo_operator']);
        }
    }

    /**
     * Преобразует данные в массив.
     *
     * @return array
     */
    public function toArray() {
        return [
            'geo_country' => $this->countries,
            'geo_region' => $this->regions,
            'geo_city' => array_map(function ($city) {
                return $city->toArray();
            }, $this->cities),
            'geo_operator' => array_map(function ($operator) {
                return $operator->toArray();
            }, $this->operators),
        ];
    }
}
