<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

/**
 *  Данный контроллер предназначен для администрирования пользователей и регулировки прав пользователей,
 * позднее он будет завязан с сервером лицензий
 */
class UserRoleController extends Controller
{
    use SubsystemConfig, UserRoleHelper;


    /**
     * Получает доступные роли пользователя по ID в ПОСТ-запросе
     * @param Request $request
     * @return void
     */
    public function getUserRoles(Request $request)
    {
        //
    }

    /**
     * обновляет конкретные роли конкретного пользователя
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function updateUserRole(Request $request)
    {
        $user = Auth::user();
        if (!$this->validateUser($user))
            return response()->json(false, 400);
        $validator = Validator::make($request->all(), [
            'subsystem' => 'required|string',
            'user_id' => 'required|integer',
            'isViewAny' => 'required|boolean',
            'isView' => 'required|boolean',
            'isCreate' => 'required|boolean',
            'isDelete' => 'required|boolean',
            'isChange' => 'required|boolean'
        ]);
        if ($validator->fails())
            return response()->json([$validator->errors()], 400);
        $updateRoles = $request->except(['user_id', 'subsystem']);
        $userId = $this->requestValue($request, 'user_id');
        $subsystem = $this->requestValue($request, 'subsystem');
        $this->updateRole($userId, $subsystem, $updateRoles);
        return response()->json(true,200);
    }

    /**
     *
     * установить пользователю административные привелегии при помощи пароля конфигурации, который будет в будущем затянут на сервер
     * лицензий
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function setUserAdmin(Request $request)
    {
        $user = Auth::user();
        if (!$this->validateUser($user))
            return response()->json(false, 400);
        $validator = Validator::make($request->all(), [
            'password' => 'required|string',
            'user_id' => 'required|integer',
        ]);
        if ($validator->fails())
            return response()->json(false, 401);
        $userRole = new Admin();
        $userRole->user_id = $this->requestValue($request, 'user_id');
        $userRole->save();
    }

    /**
     * получить значение request
     * @param Request $request
     * @param $key
     * @return mixed
     */
    private function requestValue(Request $request, $key)
    {
        return $request->only($key)[$key];
    }

    private function validateUser(User $user)
    {
        return ($user !== null) && ($this->hasAdmin($user));
    }
}
