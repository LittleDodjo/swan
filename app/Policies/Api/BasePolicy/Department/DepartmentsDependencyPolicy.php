<?php

namespace App\Policies\Api\BasePolicy\Department;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DepartmentsDependencyPolicy
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
