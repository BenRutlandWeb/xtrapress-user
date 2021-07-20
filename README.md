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

### Capabilities

The `User` class provides (via the `HasCapabilities` trait) several methods to make interacting with capabilities ~~simple~~ slightly easier.

```php
can(string $capability, ...$args): boolean
cannot(string $capability, ...$args): boolean
canAny(array $capabilities, ...$args): boolean
addCapability(string $capability): void
removeCapability(string $capability): void
```

```php
<?php

use XtraPress\User;

$user = new User(1);

$user->can('edit_posts'); // true
$user->cannot('read') // false
$user->canAny(['read', 'manage_options']) // true

$user->addCapability('tames_unicorns');
$user->removeCapability('knows_limits');
```

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

### Meta

The `User` class provides (via the `HasMeta` trait) several methods to make interacting with meta simple.

```php
hasMeta( string $key ): boolean
getMeta( string $key, mixed $default ): mixed
getAllMeta(): array
setMeta( string $key, mixed $value ): boolean
deleteMeta( string $key ): boolean
```

```php
<?php

use XtraPress\User;

$user = new User(1);

if (!$user->hasMeta('membership_number')) {
    $user->setMeta('membership_number', '00000001');
}

$user->getMeta('membership_number') // 00000001

$user->deleteMeta('membership_number');
```

### Miscellaneous

The `User` class implements `JsonSerializable` To output the user properties (including meta) as an array when enocded as JSON.

```php
<?php

use XtraPress\User;

$user = new User(1);

echo json_encode( $user );
```
