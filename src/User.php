<?php

namespace XtraPress;

use JsonSerializable;
use WP_User;

class User extends WP_User implements JsonSerializable
{
    use HasCapabilities, HasMeta, HasRoles;

    /**
     * Specify data which should be serialized to JSON
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->to_array() + $this->getAllMeta();
    }
}
