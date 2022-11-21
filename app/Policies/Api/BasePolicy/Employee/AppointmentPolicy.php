<?php

namespace App\Policies\Api\BasePolicy\Employee;

use App\Models\BaseModels\Employees\Appointment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AppointmentPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\BaseModels\Employees\Appointment  $appointment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Appointment $appointment)
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
        return $user->globalRoles->is_root;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\BaseModels\Employees\Appointment  $appointment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Appointment $appointment)
    {
        return $user->globalRoles->is_root;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\BaseModels\Employees\Appointment  $appointment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Appointment $appointment)
    {
        return $user->globalRoles->is_root;
    }
}
