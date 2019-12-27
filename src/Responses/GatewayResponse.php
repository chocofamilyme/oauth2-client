<?php

namespace Chocofamilyme\OAuth2\Client\Responses;

use Chocofamilyme\OAuth2\Client\Exceptions\OAuth2ClientResponseException;
use Chocofamilyme\OAuth2\Client\Exceptions\OAuth2ClientServerException;

class GatewayResponse implements ResponseInterface
{
    /**
     * @var string
     */
    private $responseFromServer;

    /**
     * Get auth data from response
     *
     * @return array
     */
    public function getAuthDataFromResponse(): array
    {
        return $this->responseFromServer['data'];
    }

    /**
     * Set response string
     *
     * @param string $responseFromServer
     * @throws OAuth2ClientResponseException
     * @throws OAuth2ClientServerException
     */
    public function setResponseFromServer(string $responseFromServer): void
    {
        $this->responseFromServer = json_decode($responseFromServer, true);
        $this->throwExceptionIfJsonCouldNotBeDecoded();
        $this->throwExceptionIfErrorCodeIsNotZero();
    }

    /**
     * @throws OAuth2ClientServerException
     */
    private function throwExceptionIfJsonCouldNotBeDecoded(): void
    {
        if (json_last_error() != 0) {
            throw new OAuth2ClientServerException('JSON could not be decoded');
        }
    }

    /**
     * @throws OAuth2ClientResponseException
     */
    private function throwExceptionIfErrorCodeIsNotZero(): void
    {
        if ($this->responseFromServer['error_code'] !== 0) {
            throw new OAuth2ClientResponseException($this->responseFromServer['message'], $this->responseFromServer['error_code']);
        }
    }
}