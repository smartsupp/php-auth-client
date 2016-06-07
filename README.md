[![Build Status](https://travis-ci.org/smartsupp/php-partner-client.svg)](https://travis-ci.org/smartsupp/php-partner-client)
[![Coverage Status](https://coveralls.io/repos/github/smartsupp/php-rest-client/badge.svg?branch=master)](https://coveralls.io/github/smartsupp/php-rest-client?branch=master)

# php-partner-client

## Get started

- Before start using this API, you should get your `PARTNER_KEY`. 
- Response is successfull if not contains `error` property in `$response` array.
- The `error` is machine-readable name of error, and `message` is human-readable description of error.

## create

```php
$api = new Smartsupp\Partner\Api(PARTNER_KEY);

$response = $api->create(array(
  'email' => 'LOGIN_EMAIL',       // required
  'password' => 'YOUR_PASSWORD',  // optional, min length 6 characters
  'name' => 'John Doe',           // optional
  'lang' => 'en'                  // optional, lowercase; 2 characters
));

// print_r($response);  // success response
array(
  'account' => array(
	  'key' => 'CHAT_KEY',
	  'lang' => 'en'
  ),
  'user' => array(
	  'email' => 'LOGIN_EMAIL',
	  'name' => 'John Doe',
	  'password' => 'YOUR_PASSWORD'
  )
);
```

### Errors

- `AuthError` - missing or invalid PARTNER_KEY.
- `InvalidParam` - missing or invalid parameter (e.g.: email).
- `EmailExists` - email is already taken.


## login

```php
$api = new Smartsupp\Partner\Api(PARTNER_KEY);

$response = $api->login(array(
  'email' => 'LOGIN_EMAIL',
  'password' => 'YOUR_PASSWORD'
));

// print_r($response);  // success response
array(
  'account' => array(
	  'key' => 'CHAT_KEY',
	  'lang' => 'en'
  )
);
```

### Errors

- `AuthError` - missing or invalid PARTNER_KEY.
- `InvalidParam` - missing or invalid parameter (e.g.: email is not valid, password is too short).
- `IdentityNotFound` - account with this email not exists.
- `InvalidCredential` - email exists, bad password is incorrect.
- `LoginFailure` - something is bad with login.

