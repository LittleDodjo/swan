<?php

namespace App\Policies\Api\BasePolicy\Management;

use App\Models\BaseModels\Managements\Management;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ManagementPolicy
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
     * @param  \App\Models\BaseModels\Managements\Management  $management
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Management $management)
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
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\BaseModels\Managements\Management  $management
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Management $management)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\BaseModels\Managements\Management  $management
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Management $management)
    {
        return true;
    }
}
