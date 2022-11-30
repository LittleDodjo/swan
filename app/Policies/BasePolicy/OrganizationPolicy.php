<?php

namespace App\Policies\BasePolicy;

use App\Models\BaseModel\Organization;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

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
     * @param User $user
     * @param Organization $organization
     * @return Response|bool
     */
    public function view(User $user, Organization $organization): Response|bool
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
     * @param Organization $organization
     * @return Response|bool
     */
    public function update(User $user, Organization $organization): Response|bool
    {
        return $user->role->is_root;
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
        return $user->role->is_root;
    }
}
