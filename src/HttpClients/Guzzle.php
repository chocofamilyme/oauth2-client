<?php

namespace Chocofamilyme\OAuth2\Client\HttpClients;

use GuzzleHttp\Client;

class Guzzle implements HttpClientInterface
{
    /**
     * Method request() arguments
     *
     * This is used for debugging.
     *
     * @var array
     */
    protected $requestArguments = [];

    /**
     * GuzzleHttp client
     *
     * @var \GuzzleHttp\Client
     */
    protected $client = null;

    /**
     * Guzzle constructor.
     *
     * @param array $config
     */
    public function __construct($config = [])
    {
        $this->client = new Client($config);
    }

    /**
     * {@inheritdoc}
     */
    public function request($uri, $method = 'GET', $parameters = [], $headers = [], $multipart = false)
    {
        $this->requestArguments = [
            'uri' => $uri,
            'method' => $method,
            'parameters' => $parameters,
            'headers' => $headers,
        ];

        $response = null;

        switch ($method) {
            case 'GET':
            case 'DELETE':
                $response = $this->client->request($method, $uri, [
                    'query' => $parameters,
                    'headers' => $headers,
                ]);
                break;
            case 'PUT':
            case 'POST':
                $body_type = $multipart ? 'multipart' : 'form_params';

                if (isset($this->requestHeader['Content-Type'])
                    && $headers['Content-Type'] === 'application/json'
                ) {
                    $body_type = 'json';
                }

                $body_content = $parameters;
                if ($multipart) {
                    $body_content = [];
                    foreach ($parameters as $key => $val) {
                        if ($val instanceof \CURLFile) {
                            $val = fopen($val->getFilename(), 'r');
                        }

                        $body_content[] = [
                            'name' => $key,
                            'contents' => $val,
                        ];
                    }
                }

                $response = $this->client->request($method, $uri, [
                    $body_type => $body_content,
                    'headers' => $headers,
                ]);
                break;
        }

        return $response;
    }

    /**
     * Returns method request() arguments
     *
     * This is used for debugging.
     *
     * @return array
     */
    protected function getRequestArguments()
    {
        return $this->requestArguments;
    }
}