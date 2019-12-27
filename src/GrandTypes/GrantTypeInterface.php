<?php

namespace Chocofamilyme\OAuth2\Client\GrandTypes;

interface GrantTypeInterface
{
    /**
     * Grant type params to array (is needet for http request)
     *
     * @return array
     */
    public function toArray(): array;
}