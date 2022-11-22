<?php

namespace App\Policies\Api\BasePolicy;

use App\Models\BaseModels\Organization;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrganizationPolicy
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
     * @param User|null $user
     * @param Organization $organization
     * @return bool
     */
    public function view(?User $user, Organization $organization): bool
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
     * @param User $user
     * @return mixed
     */
    public function update(User $user): mixed
    {
        return $user->globalRoles->is_root;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Organization $organization
     * @return Response|bool
     */
    public function delete(User $user, Organization $organization): Response|bool
    {
        return $user->globalRoles->is_root;
    }
}
