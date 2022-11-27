<?php

namespace App\Policies\BasePolicy\Employee;

use App\Models\BaseModel\Employee\Reason;
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
     * @param Reason $reasonPolicy
     * @return Response|bool
     */
    public function view(User $user, Reason $reasonPolicy): Response|bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user->role->is_admin || $user->role->is_root;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Reason $reasonPolicy
     * @return Response|bool
     */
    public function update(User $user, Reason $reasonPolicy): Response|bool
    {
        return $user->role->is_admin || $user->role->is_root;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Reason $reasonPolicy
     * @return Response|bool
     */
    public function delete(User $user, Reason $reasonPolicy): Response|bool
    {
        return $user->role->is_admin || $user->role->is_root;
    }
}
