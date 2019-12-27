<?php

namespace Chocofamilyme\OAuth2\Client\Responses;

use Chocofamilyme\OAuth2\Client\Exceptions\OAuth2ClientResponseException;
use Chocofamilyme\OAuth2\Client\Exceptions\OAuth2ClientServerException;

interface ResponseInterface
{
    /**
     * Get auth data from response
     *
     * @return array
     */
    public function getAuthDataFromResponse(): array;

    /**
     * Set response string
     *
     * @param string $responseFromServer
     * @throws OAuth2ClientResponseException
     * @throws OAuth2ClientServerException
     */
    public function setResponseFromServer(string $responseFromServer): void;
}