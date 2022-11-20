<?php

namespace App\Http\Controllers\Api\BaseController\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserRolesController extends Controller
{


    /**
     * @var string
     * Пароль суперпользователя
     */
    private $rootPassword = "123456";

    private $config = [
        'password' => 'required',
        'user_id' => 'required|integer',
        'is_root' => 'boolean',
        'is_admin' => 'boolean',
        'is_control_manager' => 'boolean',
    ];

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
     * @param Request $request
     * @return JsonResponse
     * JSON
     */
    public function updateRole(Request $request)
    {
        $validator = Validator::make($request->all(), $this->config);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $can = Auth::user()->can('update', Auth::user()->globalRoles);
        if (!$can && $request->password != $this->rootPassword) {
            return response()->json(false, 403);
        }
        $userRole = User::find($request->user_id);
        if ($userRole == null) return response()->json(false, 404);
        $userRole->globalRoles->update($request->except('password', 'user_id'));
        return response()->json(true);
    }
}
