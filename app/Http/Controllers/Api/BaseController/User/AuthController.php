<?php

namespace App\Http\Controllers\Api\BaseController\User;

use App\Http\Requests\Api\BaseRequest\User\AuthRequest;
use App\Http\Requests\Api\BaseRequest\User\LoginRequest;
use App\Http\Resources\Api\BaseResource\User\UserResource;
use App\Models\BaseModels\Employees\Employee;
use App\Models\UserRoles;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\User;


class AuthController extends Controller
{

    /**
     * Конструктор класса
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }


    /**
     * Создать учетную запись
     * @param AuthRequest $request
     * @return Application|Response|ResponseFactory
     */
    public function register(AuthRequest $request): Application|ResponseFactory|Response
    {
        $employee = Employee::find($request->employee_id);
        if ($employee == null) {
            return response(['message' => 'Сотрудник с таким идентификатором не найден'], 404);
        }
        if ($employee->isBusy()) {
            return response(['message' => 'Такой сотрудник уже привязан к учетной записи'], 400);
        }
        $user = new User(['login' => $request->login]);
        $user->password = Hash::make($request->password);
        $user->save();
        UserRoles::create(['user_id' => $user->id]);
        $employee->update(['user_id' => $user->id]);
        $token = Auth::login($user);
        return response(new UserResource($user), 201)->header('token', "Bearer ".$token);
    }

    /**
     * Авторизация в системе при помощи login и password.
     * @param LoginRequest $request
     * @return Application|Response|ResponseFactory
     */
    public function login(LoginRequest $request): Application|ResponseFactory|Response
    {
        $credentials = $request->only('login', 'password');
        $token = Auth::attempt($credentials);
        if ($token == null) {
            return response(['message' => 'Неудачная авторизация'], 401);
        }
        $user = Auth::user();
        return response(new UserResource($user))->header('token', "Bearer ".$token);
    }

    /**
     * Обнвоить access токен
     * @return Application|Response|ResponseFactory
     */
    public function refresh(): Application|ResponseFactory|Response
    {
        return response([])->header('token', 'Bearer '.Auth::refresh());
    }

    /**
     * Выйти из системы
     * @return Application|ResponseFactory|Response
     */
    public function logout(): Application|ResponseFactory|Response
    {
        Auth::logout();
        return response(['message' => 'Успешно']);
    }
}
