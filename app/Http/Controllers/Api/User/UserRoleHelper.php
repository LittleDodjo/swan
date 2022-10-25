<?php

namespace App\Http\Controllers\Api\User;

use App\Models\User;

/**
 *
 */
trait UserRoleHelper
{
    use SubsystemConfig;


    /**
     * Проверить является ли пользователь администратором
     * @param User $user
     * @return bool
     */
    public function hasAdmin(User $user)
    {
        return $user->can('admin', $user);
    }


    /**
     * Обновить роли пользователя
     * @param $id
     * @param $subsystem
     * @param $rolesArray
     * @return void
     */
    public function updateRole($id, $subsystem, $rolesArray){
        $subsystem = $this->subsystemRoleConfig[$subsystem];
        $userRoles = $subsystem::where('user_id', $id)->first();
        if($userRoles == null) {
            $newRole = new $subsystem();
            $newRole->user_id = $id;
            foreach ($rolesArray as $key => $value){
                $newRole->$key = $value;
            }
            $newRole->save();
        }else{
            foreach ($rolesArray as $key => $value){
                $userRoles->$key = $value;
            }
            $userRoles->save();
        }
    }


}
