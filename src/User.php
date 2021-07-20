<?php

namespace XtraPress;

use WP_User;

class User extends WP_User
{
    use HasCapabilities, HasMeta, HasRoles;
}
