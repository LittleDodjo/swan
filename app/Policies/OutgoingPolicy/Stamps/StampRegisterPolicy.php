<?php

namespace App\Policies\OutgoingPolicy\Stamps;

use App\Models\OutgoingModel\Stamps\StampRegister;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class StampRegisterPolicy
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
        return $user->is_confirmed;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param StampRegister $stampRegister
     * @return Response|bool
     */
    public function view(User $user, StampRegister $stampRegister): Response|bool
    {
        return $user->is_confirmed;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return Response|bool
     */
    public function create(User $user): Response|bool
    {
        return $user->role->is_root || $user->role->is_admin || $user->role->outgoing_manager;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param StampRegister $stampRegister
     * @return bool
     */
    public function update(User $user, StampRegister $stampRegister): bool
    {
        return $user->role->is_root || $user->role->is_admin;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param StampRegister $stampRegister
     * @return Response|bool
     */
    public function delete(User $user, StampRegister $stampRegister): Response|bool
    {
        return $user->role->is_root;
    }
}
