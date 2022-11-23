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
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param EmployeeDependency $employee
     * @return Response|bool
     */
    public function view(User $user, EmployeeDependency $employee): Response|bool
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
        return (bool) $user->isRoot() || $user->isAdmin();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param EmployeeDependency $employee
     * @return Response|bool
     */
    public function update(User $user, EmployeeDependency $employee): Response|bool
    {
        return (bool) $user->isRoot() || $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param EmployeeDependency $employee
     * @return Response|bool
     */
    public function delete(User $user, EmployeeDependency $employee): Response|bool
    {
        return (bool) $user->isRoot() || $user->isAdmin();
    }

}
