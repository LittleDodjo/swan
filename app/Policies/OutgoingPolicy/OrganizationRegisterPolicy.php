<?php

namespace App\Policies\OutgoingPolicy;

use App\Models\OutgoingModel\OrganizationRegister;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrganizationRegisterPolicy
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
     * @param  \App\Models\OutgoingModel\OrganizationRegister  $organizationRegister
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, OrganizationRegister $organizationRegister)
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
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\OutgoingModel\OrganizationRegister  $organizationRegister
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, OrganizationRegister $organizationRegister)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\OutgoingModel\OrganizationRegister  $organizationRegister
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, OrganizationRegister $organizationRegister)
    {
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\OutgoingModel\OrganizationRegister  $organizationRegister
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, OrganizationRegister $organizationRegister)
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\OutgoingModel\OrganizationRegister  $organizationRegister
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, OrganizationRegister $organizationRegister)
    {
        return true;
    }
}
