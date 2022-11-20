<?php

namespace App\Policies\Api\BasePolicy\User;

use App\Models\User;
use App\Models\UserRoles;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserRolesPolicy
{
    use HandlesAuthorization;


    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\UserRoles  $userRoles
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, UserRoles $userRoles)
    {
        return true;
    }


    /**
     * @param User $user
     * @param UserRoles $userRoles
     * @return bool
     */
    public function update(User $user, UserRoles $userRoles)
    {
        return $userRoles->is_root;
    }
}
