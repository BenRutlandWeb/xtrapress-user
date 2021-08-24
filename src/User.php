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
     * Property aliases.
     *
     * @var array
     */
    protected $aliases = [
        'id'             => 'ID',
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
     * The model object type
     *
     * @var string
     */
    protected $objectType = 'user';

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
     * Get all the user properties as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->to_array() + $this->getAllMeta();
    }

    /**
     * Get all the user properties as JSON.
     *
     * @return string
     */
    public function toJson(int $options = 0)
    {
        return json_encode($this->toArray(), $options);
    }

    /**
     * Convert the model to its string representation.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toJson();
    }

    /**
     * Specify data which should be serialized to JSON
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }
}
