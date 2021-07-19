# XtraPress User

An extended `WP_User` class.

`XtraPress\User` extends the `WP_User` class adding some useful and logical methods to make interacting with a user much simpler.

The class provides methods to interact with user roles in a more succinct manner.

## Installation

Install via Composer:

```
composer require brw/xtrapress-user
```

Use Composer's autoload:

```php
<?php

require_once __DIR__ . '/vendor/autoload.php';
```

## How to use

### Roles

The `User` class provides (via the `HasRoles` trait) several methods to make interacting with roles simple.

```php
addRole( string $role ): void
setRole( string $role ): void
removeRole( string $role ): void
getRoles(): array
hasRole( string $role ): boolean
hasAnyRoles( array $roles ): boolean
hasAllRoles( array $roles ): boolean
isSubscriber(): boolean
isContributor(): boolean
isAuthor(): boolean
isEditor(): boolean
isAdministrator(): boolean
```

```php
<?php

use XtraPress\User;

$user = new User(1);

$user->isAdministrator(); // true
$user->hasRole('subscriber') // false

$user->removeRole('administrator');
$user->addRole('subscriber');

$user->isSubscriber() // true
$user->hasRole('administrator') // false
```
