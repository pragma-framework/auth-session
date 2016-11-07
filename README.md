# Pragma AuthSession

## Prerequisites

This package uses PHP `password_hash` and `password_verify` functions, requiring minimum PHP >= 5.5

## Configuration

### config.php

In the `config.php` file, there is a `AUTH_USER_MODEL` constant, needed for a proper functioning of this package.

This constant defines the model name representing users of your application.

__Example :__

```
define('get_signed_user', 'App\\Models\\User');
```

You can also define the user's password hash generation cost. 
The system default cost is 10. You can overload this by setting `AUTH_CRYPTO_COST` to the desired value:

```
define('AUTH_CRYPTO_COST', 13);
```

### session_start()

Do not forget to start session in `public/index.php`of your application if you want to use this package.

## Available functions

### AuthSession::hashgen($pwd)

This method returns the generated hash of the clear text `$pwd` parameter.

### AuthSession::check_password($pwd, $hash)

This method compares a clear password (`$pwd`) and the user's `$hash`.

Return value will be `true` if password matches the hash, `false` otherwise.

### AuthSession::register_session($u)

This method stores identified user informations in session.

### AuthSession::signed_in()

This method returns `true` if the user is identified, `false` otherwise.

### AuthSession::get_signed_user()

This method return the object instance corresponding to the logged in user.

### AuthSession::destroy_session()

This method remove user informations from session, thus logout the user.
