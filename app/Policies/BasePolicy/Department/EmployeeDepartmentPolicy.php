<?php

namespace App\Policies\BasePolicy\Department;

use App\Models\BaseModel\Department\EmployeeDepartment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Http\Response;

class EmployeeDepartmentPolicy
{
    use HandlesAuthorization;
    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(?User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\BaseModel\Department\EmployeeDepartment  $employeeDepartment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(?User $user, EmployeeDepartment $employeeDepartment)
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
        return $user->role->is_root || $user->role->is_admin;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\BaseModel\Department\EmployeeDepartment  $employeeDepartment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, EmployeeDepartment $employeeDepartment)
    {
        return $user->role->is_root || $user->role->is_admin;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\BaseModel\Department\EmployeeDepartment  $employeeDepartment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, EmployeeDepartment $employeeDepartment)
    {
        return true;
    }
}
