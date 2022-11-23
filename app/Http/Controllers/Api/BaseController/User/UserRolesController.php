<?php

namespace App\Http\Controllers\Api\BaseController\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\BaseRequest\User\UserRolesRequest;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

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
     * @param User $user
     * @return Application|Response|ResponseFactory
     * JSON
     */
    public function updateRole(UserRolesRequest $request, User $user): Application|ResponseFactory|Response
    {
        if(Gate::allows('confirm-user') || $request->password == $this->rootPassword) {
            $user->globalRoles->update($request->except('password', 'user_id'));
            return response([true]);
        }
        return response([false]);
    }

    /**
     * Подтвердить учетную запись пользователя
     * @param User $user
     * @return Response|Application|ResponseFactory
     */
    public function confirmUser(User $user): Response|Application|ResponseFactory
    {
        if (Gate::allows('confirm-user')) {
            $user->update(['is_confirmed' => true]);
            return response([true]);
        }
        return response([false]);
    }
}
