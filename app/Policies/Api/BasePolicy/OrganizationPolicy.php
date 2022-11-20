<?php

namespace App\Policies\Api\BasePolicy;

use App\Models\BaseModels\Organization;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrganizationPolicy
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
     * @param \App\Models\User $user
     * @param Organization $organization
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(?User $user, Organization $organization)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->globalRoles->is_root;
    }


    /**
     * @param User $user
     * @return mixed
     */
    public function update(User $user)
    {
        return $user->globalRoles->is_root;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\Models\User $user
     * @param Organization $organization
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Organization $organization)
    {
        return $user->globalRoles->is_root;
    }
}
