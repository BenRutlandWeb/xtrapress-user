<?php

namespace XtraPress;

trait HasAttributes
{
    /**
     * Property aliases.
     *
     * @var array
     */
    protected static $aliases = [
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

    /**
     * {@inheritDoc}
     */
    public function __isset($key)
    {
        return parent::__isset(static::$aliases[$key] ?: $key);
    }

    /**
     * {@inheritDoc}
     */
    public function __get($key)
    {
        return parent::__get(static::$aliases[$key] ?: $key) ?: null;
    }

    /**
     * {@inheritDoc}
     */
    public function __set($key, $value)
    {
        parent::__set(static::$aliases[$key] ?: $key, $value);
    }

    /**
     * {@inheritDoc}
     */
    public function __unset($key)
    {
        parent::__unset(static::$aliases[$key] ?: $key);
    }

    /**
     * Determine if the property exists
     *
     * @param string $key
     * @return boolean
     */
    public function has(string $key)
    {
        return $this->__isset($key);
    }

    /**
     * Get the property
     *
     * @param string $key
     * @return mixed
     */
    public function get($key)
    {
        return $this->__get($key);
    }

    /**
     * Set the property
     *
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public function add(string $key, $value)
    {
        $this->__set($key, $value);
    }

    /**
     * Unset the property
     *
     * @param string $key
     * @return void
     */
    public function remove(string $key)
    {
        $this->__unset($key);
    }

    /**
     * Determine if the offset exists
     *
     * @param string $key
     * @return boolean
     */
    public function offsetExists($key)
    {
        return $this->__isset($key);
    }

    /**
     * Get the offset
     *
     * @param string $key
     * @return mixed
     */
    public function offsetGet($key)
    {
        return $this->__get($key);
    }

    /**
     * Set the offset
     *
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public function offsetSet($key, $value)
    {
        $this->__set($key, $value);
    }

    /**
     * Unset the offset
     *
     * @param string $key
     * @return void
     */
    public function offsetUnset($key)
    {
        $this->__unset($key);
    }
}
