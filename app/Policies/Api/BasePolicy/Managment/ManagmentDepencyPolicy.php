<?php

namespace App\Policies\Api\BasePolicy\Managment;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ManagmentDepencyPolicy
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
