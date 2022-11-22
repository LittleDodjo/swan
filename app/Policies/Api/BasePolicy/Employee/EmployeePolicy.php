<?php

namespace App\Policies\Api\BasePolicy\Employee;

use App\Models\BaseModels\Employees\Employee;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use JetBrains\PhpStorm\Pure;

class EmployeePolicy
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
     * @param Employee $employee
     * @return Response|bool
     */
    public function view(User $user, Employee $employee): Response|bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return bool
     */
    #[Pure] public function create(User $user): bool
    {

        return $user->isAdmin() || $user->isRoot();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Employee $employee
     * @return bool
     */
    #[Pure] public function update(User $user, Employee $employee): bool
    {
        return $user->isRoot() || ($employee->user_id == $user->id);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Employee $employee
     * @return Response|bool
     */
    #[Pure] public function delete(User $user, Employee $employee): Response|bool
    {
        return $user->isRoot();
    }

}
