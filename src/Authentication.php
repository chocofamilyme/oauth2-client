<?php

namespace Chocofamilyme\OAuth2\Client;

use Chocofamilyme\OAuth2\Client\GrandTypes\GrantTypeInterface;
use Chocofamilyme\OAuth2\Client\HttpClients\Guzzle;
use Chocofamilyme\OAuth2\Client\HttpClients\HttpClientInterface;
use Chocofamilyme\OAuth2\Client\Responses\GatewayResponse;
use Chocofamilyme\OAuth2\Client\Responses\ResponseInterface;

class Authentication
{
    /**
     * @var GrantTypeInterface
     */
    private $grantType;

    /**
     * @var string
     */
    private $authTokenUrl;

    /**
     * @var HttpClientInterface
     */
    private $httpClient;

    /**
     * @var ResponseInterface
     */
    private $responseInterface;

    /**
     * Authentication constructor
     *
     * @param GrantTypeInterface $grantType
     * @param string $authTokenUrl
     * @param HttpClientInterface $httpClient
     * @param ResponseInterface|null $responseInterface
     */
    public function __construct(GrantTypeInterface $grantType, string $authTokenUrl, HttpClientInterface $httpClient = null, ResponseInterface $responseInterface = null)
    {
        $this->grantType = $grantType;
        $this->authTokenUrl = $authTokenUrl;
        $this->setHttpClient($httpClient);
        $this->setResponseInterface($responseInterface);
    }

    /**
     * Get authentication data
     *
     * @return array
     * @throws Exceptions\OAuth2ClientResponseException
     * @throws Exceptions\OAuth2ClientServerException
     */
    public function getAuthData(): array
    {
        $responseFromServer = $this->httpClient->request($this->authTokenUrl, 'POST', $this->grantType->toArray());
        $this->responseInterface->setResponseFromServer($responseFromServer->getBody()->getContents());
        $authData = $this->responseInterface->getAuthDataFromResponse();
        return $authData;
    }

    /**
     * @param ResponseInterface $responseInterface
     */
    public function setResponseInterface(?ResponseInterface $responseInterface): void
    {
        if ($responseInterface) {
            $this->responseInterface = $responseInterface;
        } else {
            $this->responseInterface = new GatewayResponse();
        }
    }

    /**
     * @param HttpClientInterface $httpClient
     */
    public function setHttpClient(?HttpClientInterface $httpClient): void
    {
        if ($httpClient) {
            $this->httpClient = $httpClient;
        } else {
            $this->httpClient = new Guzzle([
                'verify' => false
            ]);
        }
    }
}