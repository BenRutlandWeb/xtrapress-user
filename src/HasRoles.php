<?php

namespace XtraPress;

trait HasRoles
{
    /**
     * Add role to user.
     *
     * @param string $role
     * @return void
     */
    public function addRole(string $role)
    {
        return $this->add_role($role);
    }


    /**
     * Set the role of the user.
     *
     * @param string $role
     * @return void
     */
    public function setRole(string $role)
    {
        return $this->set_role($role);
    }

    /**
     * Remove role from user.
     *
     * @param string $role
     * @return void
     */
    public function removeRole(string $role)
    {
        return $this->remove_role($role);
    }

    /**
     * Get the user role/s.
     *
     * @return array
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * Determine if the user has a role.
     *
     * @param string $role
     * @return boolean
     */
    public function hasRole(string $role)
    {
        return in_array($role, $this->roles, true);
    }

    /**
     * Determine if the user has any of the specified roles.
     *
     * @param array $roles
     * @return boolean
     */
    public function hasAnyRoles(array $roles)
    {
        return !empty(array_intersect($roles, $this->roles));
    }

    /**
     * Determine if the user has all of the specified roles.
     *
     * @param array $roles
     * @return boolean
     */
    public function hasAllRoles(array $roles)
    {
        return empty(array_diff($roles, $this->roles));
    }

    /**
     * Determine if the user is a subscriber.
     *
     * @return boolean
     */
    public function isSubscriber()
    {
        return $this->hasRole('subscriber');
    }

    /**
     * Determine if the user is a contributor.
     *
     * @return boolean
     */
    public function isContributor()
    {
        return $this->hasRole('contributor');
    }

    /**
     * Determine if the user is an author.
     *
     * @return boolean
     */
    public function isAuthor()
    {
        return $this->hasRole('author');
    }

    /**
     * Determine if the user is an editor.
     *
     * @return boolean
     */
    public function isEditor()
    {
        return $this->hasRole('editor');
    }

    /**
     * Determine if the user is an administrator.
     *
     * @return boolean
     */
    public function isAdministrator()
    {
        return $this->hasRole('administrator');
    }
}
