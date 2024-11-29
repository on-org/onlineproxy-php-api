<?php

namespace onOrg\OnlineProxyApi\Responses;

class ProxyOne extends Base
{
    public $id;
    public $login;
    public $password;
    public $protocol;
    public $host;
    public $port;
    public $geo_country;
    public $geo_city;
    public $geo_operator;
    public $private;
    public $comment;
    public $rotate_ip_url;
    public $rotate_ip_freq;
    public $start_at;
    public $stop_at;
}
