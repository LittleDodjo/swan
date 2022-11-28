<?php

namespace App\Policies\BasePolicy\Employee;

use App\Models\BaseModel\Employee\EmployeeDefaults;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class EmployeeDefaultsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param User|null $user
     * @return Response|bool
     */
    public function viewAny(?User $user): Response|bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User|null $user
     * @param EmployeeDefaults|null $default
     * @return Response|bool
     */
    public function view(?User $user, ?EmployeeDefaults $default): Response|bool
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
        return $user->role->is_admin || $user->role->is_root || $user->role->is_control && $user->is_confirmed;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param EmployeeDefaults $default
     * @return Response|bool
     */
    public function update(User $user, EmployeeDefaults $default): Response|bool
    {
        return $user->role->is_admin || $user->role->is_root || $user->role->is_control && $user->is_confirmed;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param EmployeeDefaults $default
     * @return Response|bool
     */
    public function delete(User $user, EmployeeDefaults $default): Response|bool
    {
        return $user->role->is_root || $user->role->is_admin;
    }
}
