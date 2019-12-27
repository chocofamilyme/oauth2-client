<?php

namespace Chocofamilyme\OAuth2\Client\GrandTypes;

class PasswordGrandType implements GrantTypeInterface
{
    const GRANT_TYPE = 'password';

    /**
     * @var string
     */
    private $clientId;

    /**
     * @var string
     */
    private $login;

    /**
     * @var string
     */
    private $password;

    /**
     * PasswordGrandType constructor.
     *
     * @param string $clientId
     * @param string $login
     * @param string $password
     */
    public function __construct(string $clientId, string $login, string $password)
    {
        $this->clientId = $clientId;
        $this->login = $login;
        $this->password = $password;
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
            'login' => $this->login,
            'password' => $this->password
        ];
    }
}