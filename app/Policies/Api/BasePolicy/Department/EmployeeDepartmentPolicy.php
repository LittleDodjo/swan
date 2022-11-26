<?php

namespace App\Policies\Api\BasePolicy\Department;

use App\Models\BaseModels\Departments\EmployeeDepartment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class EmployeeDepartmentPolicy
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
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param EmployeeDepartment $employeeDepartment
     * @return void
     */
    protected function view(User $user, EmployeeDepartment $employeeDepartment)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return Response|bool
     */
    public function create(User $user): Response|bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param EmployeeDepartment $employeeDepartment
     * @return Response|bool
     */
    public function update(User $user, EmployeeDepartment $employeeDepartment): Response|bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param EmployeeDepartment $employeeDepartment
     * @return Response|bool
     */
    public function delete(User $user, EmployeeDepartment $employeeDepartment): Response|bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param EmployeeDepartment $employeeDepartment
     * @return Response|bool
     */
    public function restore(User $user, EmployeeDepartment $employeeDepartment): Response|bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param EmployeeDepartment $employeeDepartment
     * @return Response|bool
     */
    public function forceDelete(User $user, EmployeeDepartment $employeeDepartment): Response|bool
    {
        //
    }
}
