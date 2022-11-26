<?php

namespace App\Policies\Api\BasePolicy\Management;

use App\Models\BaseModels\Managements\Management;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use JetBrains\PhpStorm\Pure;

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
        return $user->is_confirmed;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Management $management
     * @return Response|bool
     */
    public function view(User $user, Management $management): Response|bool
    {
        return $user->is_confirmed;
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
     * @param Management $management
     * @return Response|bool
     */
    #[Pure] public function update(User $user, Management $management): Response|bool
    {
        return $user->isAdmin() || $user->isRoot();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Management $management
     * @return Response|bool
     */
    #[Pure] public function delete(User $user, Management $management): Response|bool
    {
        return $user->isRoot();
    }
}
