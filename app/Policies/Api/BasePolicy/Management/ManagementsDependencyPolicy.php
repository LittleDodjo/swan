<?php

namespace App\Policies\Api\BasePolicy\Management;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ManagementsDependencyPolicy
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
}
