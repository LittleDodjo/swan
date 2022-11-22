<?php

namespace App\Policies\Api\BasePolicy\Employee;

use App\Models\BaseModels\Employees\EmployeeDependency;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class EmployeeDependencyPolicy
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
     * @param EmployeeDependency $employeeDepency
     * @return bool
     */
    public function view(User $user, EmployeeDependency $employeeDepency): bool
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
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param EmployeeDependency $employeeDepency
     * @return Response|bool
     */
    public function update(User $user, EmployeeDependency $employeeDepency): Response|bool
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param EmployeeDependency $employeeDepency
     * @return bool
     */
    public function delete(User $user, EmployeeDependency $employeeDepency): bool
    {
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param EmployeeDependency $employeeDepency
     * @return Response|bool
     */
    public function restore(User $user, EmployeeDependency $employeeDepency): Response|bool
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param EmployeeDependency $employeeDepency
     * @return Response|bool
     */
    public function forceDelete(User $user, EmployeeDependency $employeeDepency): Response|bool
    {
        return true;
    }
}
