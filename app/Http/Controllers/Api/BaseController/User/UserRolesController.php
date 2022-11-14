<?php

namespace App\Http\Controllers\Api\BaseController\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserRoles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserRolesController extends Controller
{

    /**
     * @var string
     * Пароль суперпользователя
     */
    public $rootPassword = "123456";

    /**
     * UserRolesController constructor.
     * Конструктор
     */
    public function __construct()
    {
        $this->middleware('api');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * Установить флаг администратора пользователю
     */
    public function setAsAdmin(Request $request)
    {
        $validator = $validator = Validator::make($request->all(), [
            'status' => 'required',
            'uid' => 'required',
            'password' => 'required',
        ]);
        if($validator->fails()){
            return response()->json();
        }
        if(!$this->validateUser($request->all()['password'])){
            return response()->json(['error'], 403);
        }
        $userId = $request->all()['uid'];
        $userRole = User::find($userId);
        if($userRole == null) return response()->json(false, 404);
        $userRole = $userRole->globalRoles;
        $userRole->is_admin = $request->all()['status'];
        $userRole->save();
        return response()->json([
            'success',
        ], 200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * Установить флаг суперпользователя
     */
    public function setAsRoot(Request $request)
    {
        $validator = $validator = Validator::make($request->all(), [
            'status' => 'required',
            'uid' => 'required',
            'password' => 'required',
        ]);
        if($validator->fails()){
            return response()->json();
        }
        if(!$this->validateUser($request->all()['password'])){
            return response()->json(['error'], 403);
        }
        $userId = $request->all()['uid'];
        $userRole = User::find($userId);
        if($userRole == null) return response()->json(false, 404);
        $userRole = $userRole->globalRoles;
        $userRole->is_root = $request->all()['status'];
        $userRole->save();
        return response()->json([
            'success',
        ], 200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * Установить флаг контролирующего сотрудника
     */
    public function setAsControlManager(Request $request)
    {
        $validator = $validator = Validator::make($request->all(), [
            'status' => 'required',
            'uid' => 'required',
            'password' => 'required',
        ]);
        if($validator->fails()){
            return response()->json();
        }
        if(!$this->validateUser($request->all()['password'])){
            return response()->json(['error'], 403);
        }
        $userId = $request->all()['uid'];
        $userRole = User::find($userId);
        if($userRole == null) return response()->json(false, 404);
        $userRole = $userRole->globalRoles;
        $userRole->is_control_manager = $request->all()['status'];
        $userRole->save();
        return response()->json([
            'success',
        ], 200);
    }

    /**
     * @param $password
     * @return bool
     *
     * Проверить права пользователя
     */
    private function validateUser($password){
        $userRoles = Auth::user();
        if($userRoles == null) return false;
        if($userRoles->globalRoles->is_root) return  true;
        return $password === $this->rootPassword;
    }

}
