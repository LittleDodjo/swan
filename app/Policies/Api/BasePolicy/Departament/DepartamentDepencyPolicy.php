<?php

namespace App\Policies\Api\BasePolicy\Departament;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DepartamentDepencyPolicy
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
