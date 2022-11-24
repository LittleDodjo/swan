<?php

namespace App\Policies\Api\BasePolicy;

use App\Models\BaseModels\Organization;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;
use JetBrains\PhpStorm\Pure;

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
     * @return bool
     */
    #[Pure] public function create(User $user): bool
    {
        return $user->isRoot();
    }


    /**
     * @param User $user
     * @return bool
     */
    #[Pure] public function update(User $user): bool
    {
        return $user->isRoot();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Organization $organization
     * @return bool
     */
    #[Pure] public function delete(User $user, Organization $organization): bool
    {
        return $user->isRoot();
    }
}
