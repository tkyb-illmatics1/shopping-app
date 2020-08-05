<?php

namespace App\Policies;

use App\Models\AdminUser;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminUserPolicy
{
    use HandlesAuthorization;

    /**
     *
     * @param  AdminUser  $loginUser
     * @return boolean
     */
    public function index(AdminUser $loginUser)
    {
        return $loginUser->is_owner == 1;
    }

    /**
     *
     * @param  AdminUser  $loginUser
     * @return boolean
     */
    public function create(AdminUser $loginUser)
    {
        return $loginUser->is_owner == 1;
    }

    /**
     *
     * @param  AdminUser  $loginUser
     * @return boolean
     */
    public function store(AdminUser $loginUser)
    {
        return $loginUser->is_owner == 1;
    }

    /**
     *
     * @param  AdminUser  $loginUser
     * @param  AdminUser  $adminUser
     * @return boolean
     */
    public function show(AdminUser $loginUser, AdminUser $adminUser)
    {
        return $loginUser->is_owner == 1 && $loginUser->id == $adminUser->id;
    }

    /**
     *
     * @param  AdminUser  $loginUser
     * @param  AdminUser  $adminUser
     * @return boolean
     */
    public function edit(AdminUser $loginUser, AdminUser $adminUser)
    {
        return $loginUser->is_owner == 1 && $loginUser->id !== $adminUser->id;
    }

    /**
     *
     * @param  AdminUser  $loginUser
     * @param  AdminUser  $adminUser
     * @return boolean
     */
    public function update(AdminUser $loginUser, AdminUser $adminUser)
    {
        return $loginUser->is_owner == 1 || $loginUser->id == $adminUser->id;
    }

    /**
     *
     * @param  AdminUser  $loginUser
     * @param  AdminUser  $adminUser
     * @return boolean
     */
    public function delete(AdminUser $loginUser, AdminUser $adminUser)
    {
        return $loginUser->is_owner == 1 && $loginUser->id !== $adminUser->id;
    }
}
