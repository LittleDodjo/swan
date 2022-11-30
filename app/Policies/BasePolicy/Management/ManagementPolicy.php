<?php

namespace App\Policies\BasePolicy\Management;

use App\Models\BaseModel\Management\Management;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ManagementPolicy
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
     * @param Management $management
     * @return bool
     */
    public function view(User $user, Management $management): bool
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
        return $user->role->is_root;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Management $management
     * @return Response|bool
     */
    public function update(User $user, Management $management): Response|bool
    {
        return $user->role->is_root;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Management $management
     * @return Response|bool
     */
    public function delete(User $user, Management $management): Response|bool
    {
        return $user->role->is_root;
    }
}
