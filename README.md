[![Build Status](https://travis-ci.org/smartsupp/php-auth-client.svg)](https://travis-ci.org/smartsupp/php-auth-client)
[![Coverage Status](https://coveralls.io/repos/github/smartsupp/php-auth-client/badge.svg?branch=master)](https://coveralls.io/github/smartsupp/php-auth-client?branch=master)

# Smartsupp Authentication API PHP client

* https://www.smartsupp.com/

## Get started

- Response is successfull if not contains `error` property in `$response` array.
- The `error` is machine-readable name of error, and `message` is human-readable description of error.

## create

```php
$api = new Smartsupp\Auth\Api();

$response = $api->create(array(
  'email' => 'LOGIN_EMAIL',           // required
  'password' => 'YOUR_PASSWORD',      // optional, min length 6 characters
  'name' => 'John Doe',               // optional
  'lang' => 'en',                     // optional, lowercase; 2 characters
  'partnerKey' => 'PARTNER_API_KEY'   // optional
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

// print_r($response); // failure response
array(
    'error' => 'EmailExists',
    'message' => 'Email already exists',
    'hint' => 'email'
);
```

### Errors

- `AuthError` - invalid PARTNER_KEY.
- `InvalidParam` - missing or invalid parameter (e.g.: email).
- `EmailExists` - email is already taken.


## login

```php
$api = new Smartsupp\Auth\Api();

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

// print_r($response); // failure response
array(
  'error' => 'InvalidCredential',
  'message' => 'Invalid password'
);
```

### Errors

- `AuthError` - invalid PARTNER_KEY.
- `InvalidParam` - missing or invalid parameter (e.g.: email is not valid, password is too short).
- `IdentityNotFound` - account with this email not exists.
- `InvalidCredential` - email exists, bad password is incorrect.
- `LoginFailure` - something is bad with login.

## Requirements

### 1.x
For backward compatibility with multiple plugins library supports PHP starting from version 5.3. It is highly possibly the constraint will change to 5.6+ in near future.

### 2.x
Minimum required PHP version is 7.3.

Theoretically this is only required by phpunit 9 which is used for tests.
In theory the library code should still work with PHP versions down to 5.3,
but tests for these versions are no longer available.

## Copyright

Copyright (c) 2016-2020 Smartsupp.com, s.r.o.
