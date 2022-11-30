<?php

namespace App\Http\Controllers\BaseController;

use App\Http\Controllers\Controller;
use App\Http\Requests\BaseRequest\ConfirmRequest;
use App\Http\Requests\BaseRequest\RoleRequest;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserRoleController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }


    /**
     * Обновить роли пользователя
     * @param RoleRequest $request
     * @param User $user
     * @return Response
     */
    public function role(RoleRequest $request,User $user): Response
    {
        $user->role->update($request->validated());
        return response(['message' => 'Роли учетной записи обновлены']);
    }

    /**
     * Подтвердить учетную запись
     * @param ConfirmRequest $request
     * @param User $user
     * @return Response
     */
    public function confirm(ConfirmRequest $request, User $user): Response
    {
        $user->update($request->validated());
        return response(['message' => 'Учетная запись подтверждена']);
    }
}
