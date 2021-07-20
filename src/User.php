<?php

namespace XtraPress;

use JsonSerializable;
use WP_User;

class User extends WP_User implements JsonSerializable
{
    use HasCapabilities, HasMeta, HasRoles;

    /**
     * Remove user.
     *
     * @return boolean
     */
    public function delete()
    {
        return wp_delete_user($this->ID);
    }

    /**
     * Specify data which should be serialized to JSON
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->to_array() + $this->getAllMeta();
    }

    /**
     * {@inheritDoc}
     */
    public function __isset($key)
    {
        return parent::__isset($this->aliasedKey($key));
    }

    /**
     * {@inheritDoc}
     */
    public function __get($key)
    {
        return parent::__get($this->aliasedKey($key)) ?: null;
    }

    /**
     * {@inheritDoc}
     */
    public function __set($key, $value)
    {
        parent::__set($this->aliasedKey($key), $value);
    }

    /**
     * {@inheritDoc}
     */
    public function __unset($key)
    {
        parent::__unset($this->aliasedKey($key));
    }

    /**
     * Determine if a key is aliased.
     *
     * @param string $key
     * @return string
     */
    protected function aliasedKey(string $key)
    {
        $aliases = [
            'login'          => 'user_login',
            'username'       => 'user_login',
            'pass'           => 'user_pass',
            'password'       => 'user_pass',
            'nicename'       => 'user_nicename',
            'slug'           => 'user_nicename',
            'email'          => 'user_email',
            'url'            => 'user_url',
            'registered'     => 'user_registered',
            'activation_key' => 'user_activation_key',
            'status'         => 'user_status',
        ];

        return $aliases[$key] ?: $key;
    }
}
