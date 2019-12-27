<?php

namespace Chocofamilyme\OAuth2\Client\GrandTypes;

class ClientCredentialsGrandType implements GrantTypeInterface
{
    const GRANT_TYPE = 'client_credentials';

    /**
     * @var string
     */
    private $clientId;

    /**
     * @var string
     */
    private $clientSecret;

    /**
     * PasswordGrandType constructor.
     *
     * @param string $clientId
     * @param string $clientSecret
     */
    public function __construct(string $clientId, string $clientSecret)
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
    }

    /**
     * Grant type params to array (is needet for http request)
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'grant_type' => self::GRANT_TYPE,
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret
        ];
    }
}