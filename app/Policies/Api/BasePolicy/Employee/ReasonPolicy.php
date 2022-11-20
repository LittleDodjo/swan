<?php

namespace App\Policies\Api\BasePolicy\Employee;

use App\Models\BaseModels\Employees\Reason;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReasonPolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if($user != null) return true;
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param \App\Models\User $user
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
     * @param \App\Models\BaseModels\Employees\Reason $reason
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, ?Reason $reason)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\BaseModels\Employees\Reason $reason
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Reason $reason)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\BaseModels\Employees\Reason $reason
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Reason $reason)
    {
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\BaseModels\Employees\Reason $reason
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Reason $reason)
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\BaseModels\Employees\Reason $reason
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Reason $reason)
    {
        return true;
    }
}
