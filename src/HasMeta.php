<?php

namespace XtraPress;

use RuntimeException;

trait HasMeta
{
    /**
     * Determine if the meta value exists.
     *
     * @param string $key
     * @return boolean
     */
    public function hasMeta(string $key)
    {
        return metadata_exists('user', $this->ID, $key);
    }

    /**
     * Get a meta value.
     *
     * @param string $key
     * @param mixed|null $default
     * @return mixed
     */
    public function getMeta(string $key, $default = null)
    {
        return get_metadata('user', $this->ID, $key, true) ?: $default;
    }

    /**
     * Set the meta value.
     *
     * @param string $key
     * @param mixed $value
     * @return boolean
     */
    public function setMeta(string $key, $value)
    {
        if ($this->getMeta($key) === $value) {
            return true;
        }

        return update_metadata('user', $this->ID, $key, $value) !== false;
    }

    /**
     * Delete the meta value.
     *
     * @param string $key
     * @return boolean
     */
    public function deleteMeta(string $key)
    {
        return delete_metadata('user', $this->ID, $key);
    }
}
