<?php

namespace App\Policies\Api\BasePolicy\Employee;

use App\Models\BaseModels\Employees\EmployeeDefaults;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class EmployeeDefaultsPolicy
{
    use HandlesAuthorization;


    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param EmployeeDefaults $employeeDefaults
     * @return Response|bool
     */
    public function view(User $user, EmployeeDefaults $employeeDefaults): Response|bool
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
        $roles = $user->globalRoles;
        return $roles->is_admin || $roles->is_control_manager || $roles->is_root;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param EmployeeDefaults $employeeDefaults
     * @return bool
     */
    public function delete(User $user, EmployeeDefaults $employeeDefaults): bool
    {
        $roles = $user->globalRoles;
        return $roles->is_admin || $roles->is_control_manager || $roles->is_root;
    }
}
