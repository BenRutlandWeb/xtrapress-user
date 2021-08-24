<?php

namespace XtraPress;

trait HasAttributes
{
    /**
     * {@inheritDoc}
     */
    public function __isset($key)
    {
        return parent::__isset($this->getAlias($key));
    }

    /**
     * {@inheritDoc}
     */
    public function __get($key)
    {
        return parent::__get($this->getAlias($key)) ?: null;
    }

    /**
     * {@inheritDoc}
     */
    public function __set($key, $value)
    {
        parent::__set($this->getAlias($key), $value);
    }

    /**
     * {@inheritDoc}
     */
    public function __unset($key)
    {
        parent::__unset($this->getAlias($key));
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

    /**
     * Get an attribute by its alias
     *
     * @param string $key
     * @return string
     */
    protected function getAlias(string $key)
    {
        return $this->aliases[$key] ?: $key;
    }
}
