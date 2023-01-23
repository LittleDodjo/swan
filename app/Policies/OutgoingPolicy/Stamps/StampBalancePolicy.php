<?php

namespace App\Policies\OutgoingPolicy\Stamps;

use App\Models\OutgoingModel\Stamps\StampBalance;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class StampBalancePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * @param User $user
     * @return bool
     */
    public function store(User $user): bool
    {
        return $user->role->outgoing_manager && $user->is_confirmed;
    }
}
