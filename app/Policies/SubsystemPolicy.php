<?php

namespace App\Policies;

use App\Models\Subsystem\Outgoing\OutDocument;
use App\Models\Subsystem\Outgoing\OutUsersRole;
use App\Models\User;
use App\Models\Admin;
use Psy\Exception\ErrorException;

trait SubsystemPolicy
{


    /**
     * Возвращает статус администратора
     * @param User $user
     * @return bool
     */
    public function isAdmin(User $user)
    {
        return $user->first()->Admin !== null;
    }


    /**
     * Возвразщает роли
     * @param User $user
     * @param string $action
     * @return bool
     */
    public function isRole(User $user, string $action)
    {
        $roles = $user->first()->OutUserRole;
        if ($roles == null) return false;
        return (bool)$roles[$action];
    }
}
