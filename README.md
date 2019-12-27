# OAuth 2.0 authentication client
OAuth 2.0 authentication client. It provides multiple grant types, using which you can get authentication data.

# Installation
```bash
composer require chocofamilyme/oauth2-client
```

# Usage
## Grand type "password"
```php
<?php
use Chocofamilyme\OAuth2\Client\Authentication;
use Chocofamilyme\OAuth2\Client\GrandTypes\PasswordGrandType;

$grantType = new PasswordGrandType('client_id', 'username', 'password');
$oauth2 = new Authentication($grantType, 'http://oauth.server.com/auth/token');
$authData = $oauth2->getAuthData();
var_dump($authData);
```

## Grand type "client_credentials"
```php
<?php
use Chocofamilyme\OAuth2\Client\Authentication;
use Chocofamilyme\OAuth2\Client\GrandTypes\ClientCredentialsGrandType;

$grantType = new ClientCredentialsGrandType('client_id', 'client_secret');
$oauth2 = new Authentication($grantType, 'http://oauth.server.com/auth/token');
$authData = $oauth2->getAuthData();
var_dump($authData);
```

# Extending
- You can also extend this library with your grant types, see ```GrantTypeInterface```.
- You can also use your own http client, it just has to implement ```HttpClientInterface```
- If your OAuth 2.0 server gives the response not in the format this library can understand, just write your own response class which has to implement ```ResponseInterface```

Every custom module can then be used in the constructor of the Authentication class
```
new \Chocofamilyme\OAuth2\Client\Authentication(GrantTypeInterface $grantType, string $authTokenUrl, HttpClientInterface $httpClient = null, ResponseInterface $responseInterface = null)
```