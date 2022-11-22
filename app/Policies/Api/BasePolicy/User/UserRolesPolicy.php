<?php

namespace App\Policies\Api\BasePolicy\User;

use App\Models\User;
use App\Models\UserRoles;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class UserRolesPolicy
{
    use HandlesAuthorization;


    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return Response|bool
     */
    public function viewAny(User $user): Response|bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param UserRoles $userRoles
     * @return bool
     */
    public function view(User $user, UserRoles $userRoles): bool
    {
        return true;
    }


    /**
     * @param User $user
     * @param UserRoles $userRoles
     * @return bool
     */
    public function update(User $user, UserRoles $userRoles): bool
    {
        return $userRoles->is_root;
    }
}
