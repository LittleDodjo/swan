<?php

namespace App\Policies\Api\BasePolicy\Employee;

use App\Models\BaseModels\Employees\Reason;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ReasonPolicy
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
     * @param Reason|null $reason
     * @return Response|bool
     */
    public function view(User $user, ?Reason $reason): Response|bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return Response|bool
     */
    public function create(User $user): Response|bool
    {
        return $user->globalRoles->is_admin || $user->globalRoles->is_control_manager;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Reason $reason
     * @return Response|bool
     */
    public function update(User $user, Reason $reason): Response|bool
    {
        return $user->globalRoles->is_admin || $user->globalRoles->is_control_manager;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Reason $reason
     * @return bool
     */
    public function delete(User $user, Reason $reason): bool
    {
        return $user->globalRoles->is_admin || $user->globalRoles->is_control_manager;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Reason $reason
     * @return Response|bool
     */
    public function restore(User $user, Reason $reason): Response|bool
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param Reason $reason
     * @return Response|bool
     */
    public function forceDelete(User $user, Reason $reason): Response|bool
    {
        return true;
    }
}
