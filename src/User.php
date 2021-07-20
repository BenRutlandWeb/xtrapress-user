<?php

namespace XtraPress;

use ArrayAccess;
use Illuminate\Support\Traits\Macroable;
use JsonSerializable;
use WP_User;

class User extends WP_User implements ArrayAccess, JsonSerializable
{
    use HasAttributes, HasCapabilities, HasMeta, HasRoles, Macroable;

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
     * Get all the user properties.
     *
     * @return array
     */
    public function all()
    {
        return $this->to_array() + $this->getAllMeta();
    }

    /**
     * Convert the model to its string representation.
     *
     * @return string
     */
    public function __toString()
    {
        return json_encode($this->all());
    }

    /**
     * Specify data which should be serialized to JSON
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->all();
    }
}
