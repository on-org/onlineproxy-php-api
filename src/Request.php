<?php

namespace onOrg\OnlineProxyApi;

use Exception;
use onOrg\OnlineProxyApi\Exceptions\NoNumberException;
use onOrg\OnlineProxyApi\Exceptions\RequestException;

class Request
{
    private $url = 'https://onlineproxy.io/api/client/v1/';
    private $apiKey;
    private $dev_id;
    private $locale;

    public function __construct($apiKey, $locale, $dev_id = null) {
        $this->apiKey = $apiKey;
        $this->dev_id = $dev_id;
        $this->locale = $locale;
    }

    public function setDomain($domain):void {
        $this->url = "https://{$domain}/api/client/v1/";
    }

    /**
     * @param string $request
     * @param array $data
     * @param string $method
     * @return mixed
     * @throws RequestException|NoNumberException|Exception
     */
    public function send($request, $data, $method = 'GET') {
        if ($this->dev_id) {
            $data['dev_id'] = $this->dev_id;
        }

        $serializedData = http_build_query($data);
        $url = "{$this->url}{$request}";
        $headers = [
            "Authorization: Bearer {$this->apiKey}",
            'Content-type: application/x-www-form-urlencoded'
        ];

        if ($method === 'GET') {
            $url .= ".php?{$serializedData}";
            $context = stream_context_create([
                'http' => [
                    'header' => implode("\r\n", $headers),
                    'method' => 'GET',
                ],
            ]);
        } else {
            $context = stream_context_create([
                'http' => [
                    'header' => implode("\r\n", $headers),
                    'method' => 'POST',
                    'content' => $serializedData
                ],
            ]);
        }

        $result = file_get_contents($url, false, $context);
        $result = json_decode($result, true);

        if (isset($result['response'])) {
            if ((int)$result['response'] !== 1) {
                if ($result['response'] === 'NO_NUMBER' || $result['response'] === 'NO_NUMBER_FOR_FORWARD') {
                    throw new NoNumberException($result['response']);
                }
                throw new RequestException($result['response'], $this->locale);
            }
            unset($result['response']);
        }

        return $result;
    }

    public function getLocale() {
        return $this->locale;
    }
}
