<?php

namespace App\Policies\Api\BasePolicy\Employee;

use App\Models\BaseModels\Employees\EmployeeDefaults;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EmployeeDefaultsPolicy
{
    use HandlesAuthorization;


    /**
     * Determine whether the user can view the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\BaseModels\Employees\EmployeeDefaults $employeeDefaults
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, EmployeeDefaults $employeeDefaults)
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
        $roles = $user->globalRoles;
        return $roles->is_admin || $roles->is_control_manager || $roles->is_root;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\BaseModels\Employees\EmployeeDefaults $employeeDefaults
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, EmployeeDefaults $employeeDefaults)
    {
        $roles = $user->globalRoles;
        return $roles->is_admin || $roles->is_control_manager || $roles->is_root;
    }
}
