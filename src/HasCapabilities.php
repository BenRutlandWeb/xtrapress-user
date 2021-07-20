<?php

namespace XtraPress;

trait HasCapabilities
{
    /**
     * Returns whether the user has the specified capability.
     *
     * @param string $capability
     * @param mixed ...$args
     * @return boolean
     */
    public function can(string $capability, ...$args)
    {
        return $this->has_cap($capability, ...$args);
    }

    /**
     * Returns whether the user does not have the specified capability.
     *
     * @param string $capability
     * @param mixed ...$args
     * @return boolean
     */
    public function cannot(string $capability, ...$args)
    {
        return !$this->can($capability, ...$args);
    }

    /**
     * Returns whether the user has the any of the specified capabilities.
     *
     * @param string $capability
     * @param mixed ...$args
     * @return boolean
     */
    public function canAny(array $capabilities, ...$args)
    {
        foreach ($capabilities as $capability) {
            if ($this->can($capability, ...$args)) {
                return true;
            };
        }

        return false;
    }

    /**
     * Add capability to user.
     *
     * @param string $capability
     * @return void
     */
    public function addCapability(string $capability)
    {
        $this->add_cap($capability);
    }

    /**
     * Remove capability from user.
     *
     * @param string $capability
     * @return void
     */
    public function removeCapability(string $capability)
    {
        $this->remove_cap($capability);
    }
}
