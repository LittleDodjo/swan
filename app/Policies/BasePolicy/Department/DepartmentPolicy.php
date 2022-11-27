<?php

namespace App\Policies\BasePolicy\Department;

use App\Models\BaseModel\Department\Department;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class DepartmentPolicy
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
     * @param Department $department
     * @return bool
     */
    public function view(User $user, Department $department): bool
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
        return $user->role->is_admin || $user->role->is_root;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Department $department
     * @return bool
     */
    public function update(User $user, Department $department): bool
    {
        return $user->role->is_admin || $user->role->is_root;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Department $department
     * @return bool
     */
    public function delete(User $user, Department $department): bool
    {
        return $user->role->is_admin || $user->role->is_root;
    }
}
