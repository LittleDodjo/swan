<?php

namespace App\Policies\Outgoing\Stamps;

use App\Models\Outgoing\Stamps\StampRegister;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class StampRegisterPolicy
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
        return $user->is_confirmed;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Outgoing\Stamps\StampRegister  $stampRegister
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, StampRegister $stampRegister)
    {
        return $user->is_confirmed;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->role->is_root;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Outgoing\Stamps\StampRegister  $stampRegister
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, StampRegister $stampRegister)
    {
        return $user->role->is_root;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Outgoing\Stamps\StampRegister  $stampRegister
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, StampRegister $stampRegister)
    {
        return true;
    }
}
