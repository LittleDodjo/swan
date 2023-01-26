<?php

namespace App\Http\Controllers\BaseController;

use App\Http\Controllers\Controller;
use App\Http\Requests\BaseRequest\LoginRequest;
use App\Http\Requests\BaseRequest\RegisterRequest;
use App\Http\Resources\BaseResource\UserResource;
use App\Models\BaseModel\Employee\Employee;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register', 'email']]);
    }

    /**
     * Регистрация учетной записи
     * @param RegisterRequest $request
     * @return Response|Application|ResponseFactory
     */
    public function register(RegisterRequest $request): Response|Application|ResponseFactory
    {
        $employee = Employee::find($request->employee_id);
        $user = new User(['login' => $request->login]);
        $user->password = Hash::make($request->password);
        $user->save();
        $employee->update(['user_id' => $user->id]);
        return response(new UserResource($user), 201)
            ->header('Authorization', 'Bearer ' . Auth::login($user));
    }

    /**
     * Авторизация
     * @param LoginRequest $request
     * @return Response|Application|ResponseFactory
     */
    public function login(LoginRequest $request): Response|Application|ResponseFactory
    {
        $token = Auth::attempt($request->validated());
        if ($token == null) {
            return response(['message' => 'Неудачная авторизация'], 401);
        }
        return response(new UserResource(Auth::user()))
            ->header('Authorization', 'Bearer ' . $token);
    }

    /**
     * Обновить токен
     * @return Response|Application|ResponseFactory
     */
    public function refresh(): Response|Application|ResponseFactory
    {
        return response([])
            ->header('Authorization', 'Bearer ' . Auth::refresh());
    }

    /**
     * Выйти из системы
     * @return Application|Response|ResponseFactory
     */
    public function logout(): Response|Application|ResponseFactory
    {
        Auth::logout();
        return \response([true]);
    }

    /**
     * @param string $email
     * @return Response|Application|ResponseFactory
     */
    public function email(string $email): Response|Application|ResponseFactory
    {
        $employee = Employee::where('email', $email)->first();
        if($employee == null) return response(['message' => 'Сотрудник не найден'], 404);
        if($employee->user != null) return response(['message' => 'У данного сотрудника уже есть учетная запись'], 400);
        return response(["employee_id" => $employee->id]);
    }

}
