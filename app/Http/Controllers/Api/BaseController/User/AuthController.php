<?php

namespace App\Http\Controllers\Api\BaseController\User;

use App\Http\Requests\Api\BaseRequest\User\AuthRequest;
use App\Http\Resources\Api\BaseResource\User\UserResource;
use App\Models\BaseModels\Employees\Employee;
use App\Models\UserRoles;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;


class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }


    public function register(AuthRequest $request)
    {
        $employee = Employee::find($request->employee_id);
        if ($employee == null) {
            return response()->json(['message' => 'Сотрудник с таким идентификатором не найден'], 404);
        }
        if ($employee->isBusy()) {
            return response()->json(['message' => 'Такой сотрудник уже привязан к учетной записи'], 400);
        }
        $user = new User(['login' => $request->login]);
        $user->password = Hash::make($request->password);
        $user->save();
        UserRoles::create(['user_id' => $user->id]);
        $employee->user_id = $user->id;
        $employee->save();
        $token = Auth::login($user);
        return response()->json([
            'message' => 'Регистрация прошла успешно',
            'user' => new UserResource($user),
            'token' => 'Bearer ' . $token,
        ], 201);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'login' => 'required',
            'password' => 'required',
        ], [
            'login.required' => 'Необходимо оказать логин',
            'password.required' => 'Необходимо указать пароль'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $credentials = $request->only('login', 'password');
        $token = Auth::attempt($credentials);
        if (!$token) {
            return response()->json(['message' => 'Неудачная авторизация'], 401);
        }
        $user = Auth::user();
        return response()->json([
            'message' => 'Авторизация прошла успешно',
            'user' => new UserResource($user),
            'token' => 'Bearer ' . $token,
        ]);
    }

    public function refresh()
    {
        return response()->json([
            'token' => 'Bearer ' . Auth::refresh(),
        ], 200);
    }

    public function logout()
    {
        Auth::logout();
        return response()->json([
            'status' => 'Успешно',
            'message' => 'Вы успешно вышли из системы',
        ]);
    }
}
