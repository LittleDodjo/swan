<?php

namespace App\Policies\Api\BasePolicy\Employee;

use App\Models\BaseModels\Employees\Appointment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class AppointmentPolicy
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
     * @param Appointment $appointment
     * @return bool
     */
    public function view(User $user, Appointment $appointment): bool
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
        return $user->globalRoles->is_root;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Appointment $appointment
     * @return Response|bool
     */
    public function update(User $user, Appointment $appointment): Response|bool
    {
        return $user->globalRoles->is_root;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Appointment $appointment
     * @return Response|bool
     */
    public function delete(User $user, Appointment $appointment): Response|bool
    {
        return $user->globalRoles->is_root;
    }
}
