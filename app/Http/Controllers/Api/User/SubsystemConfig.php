<?php
/*
 * Copyright (c) 2022. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
 * Morbi non lorem porttitor neque feugiat blandit. Ut vitae ipsum eget quam lacinia accumsan.
 * Etiam sed turpis ac ipsum condimentum fringilla. Maecenas magna.
 * Proin dapibus sapien vel ante. Aliquam erat volutpat. Pellentesque sagittis ligula eget metus.
 * Vestibulum commodo. Ut rhoncus gravida arcu.
 */

namespace App\Http\Controllers\Api\User;

use App\Models\Subsystem\Outgoing\OutUsersRole;

/**
 * Конфигурация подсистем
 * Ссылается на табилцы Ролей подсистемы
 * С конфигурацией пароля администратора
 */
trait SubsystemConfig
{

    /**
     * Пароль администратора
     * @var string
     */
    protected $adminPassword = "123456";

    /**
     * Конфигурация подсистем приложения
     * @var string[]
     */
    protected $subsystemRoleConfig = [
        'outgoing' => OutUsersRole::class,
    ];

}
