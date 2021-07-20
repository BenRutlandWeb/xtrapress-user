# XtraPress User

An extended `WP_User` class.

`XtraPress\User` extends the `WP_User` class adding some useful and logical methods to make interacting with a user much simpler.

The class provides methods to interact with user roles, capabilities, meta and properties in a more succinct manner.

## Installation

Install via Composer:

```
composer require xtrapress/user
```

Use Composer's autoload:

```php
<?php

require_once __DIR__ . '/vendor/autoload.php';
```

## How to use

### Attributes

The `User` class magic methods: `__isset`, `__get`, `__set` and `__unset` have been enhanced with aliased keys, so you don't have to prefix the core properties with "user\_". The class also implements `ArrayAccess`, and provides `has`, `get`, `add`, and `remove` methods.

```php
<?php

use XtraPress\User;

$user = new User(1);

isset($user->email); // true
$user->email; // same as $user->user_email
$user->email = 'email@example.com'; // sets $user->user_email property
unset($user->email); // unsets $user->user_email property

isset($user['email']);
$user['email'];
$user['email'] = 'email@example.com';
unset($user['email']);

$user->has('email');
$user->get('email');
$user->add('email', 'email@example.com');
$user->remove('email');

```

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

### Macros

The `User` class provides a `macro` method to add custom functionality to the class. This is useful for custom roles. The user instance is bound to `$this`, and the parameters are passed to the given callback.

```php
<?php

use XtraPress\User;

User::macro('isCrustyJuggler', function() {
    return $this->hasRole('crusty_juggler');
});

User::macro('name', function() {
    return $this->first_name . ' ' . $this->last_name;
});

User::macro('login', function (string $email, string $password, bool $remember = false) {
    return wp_signon([
        'user_login'    => $email,
        'user_password' => $password,
        'remember'      => $remember,
    ]);
});

$user = new User(1);

$user->isCrustyJuggler(); // true
$user->name(); // John Doe

User::login('email@example.com', 'password', true);
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

### Miscellaneous

You can delete the user with the `delete` method.

```php
<?php

use XtraPress\User;

$user = new User(1);

$user->delete();
```

The `User` class implements `JsonSerializable` To output the user properties (including meta) as an array when enocded as JSON.

```php
<?php

use XtraPress\User;

$user = new User(1);

echo json_encode( $user );
```
