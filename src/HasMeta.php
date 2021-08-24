<?php

namespace XtraPress;

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
        return metadata_exists($this->objectType, $this->ID, $key);
    }

    /**
     * Retrieve the value of a property or meta key.
     *
     * @param string $key
     * @param mixed|null $default
     * @return mixed
     */
    public function getMeta(string $key, $default = null)
    {
        return $this->get($key) ?: $default;
    }

    /**
     * Get all the user meta.
     *
     * @return array
     */
    public function getAllMeta()
    {
        return array_map(function ($meta) {
            return maybe_unserialize(count($meta) !== 1 ? $meta : $meta[0]);
        }, get_metadata($this->objectType, $this->ID));
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

        return update_metadata($this->objectType, $this->ID, $key, $value) !== false;
    }

    /**
     * Delete the meta value.
     *
     * @param string $key
     * @return boolean
     */
    public function deleteMeta(string $key)
    {
        return delete_metadata($this->objectType, $this->ID, $key);
    }
}
