<?php

namespace App\Http\Controllers\Api\BaseController\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\BaseRequest\User\UserRolesRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserRolesController extends Controller
{


    /**
     * @var string
     * Пароль суперпользователя
     */
    private string $rootPassword = "123456";

    /**
     * UserRolesController constructor.
     * Конструктор
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Установить флаг администратора пользователю
     * @param UserRolesRequest $request
     * @return JsonResponse
     * JSON
     */
    public function updateRole(UserRolesRequest $request): JsonResponse
    {
        $userRole = User::find($request->user_id);
        if ($userRole == null) return response()->json(false, 404);
        $userRole->globalRoles->update($request->except('password', 'user_id'));
        return response()->json(true);
    }
}
