<?php

use Chocofamilyme\OAuth2\Client\Authentication;
use Chocofamilyme\OAuth2\Client\GrandTypes\ClientCredentialsGrandType;
use Chocofamilyme\OAuth2\Client\GrandTypes\PasswordGrandType;

require_once('vendor/autoload.php');

//$grantType = new PasswordGrandType('-5', 'igor875126@gmail.com', '4ErDDnhz');
$grantType = new ClientCredentialsGrandType('-5', '3d05b2e9d092638188bc203a8962d1614e71aedff433c1b787d0a19e2ce88b3d');
$oauth2 = new Authentication($grantType, 'http://gateway.local/auth/token');
$authData = $oauth2->getAuthData();
var_dump($authData);