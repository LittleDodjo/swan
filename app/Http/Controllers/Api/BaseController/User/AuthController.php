<?php

namespace App\Http\Controllers\Api\BaseController\User;

use App\Models\BaseModels\Employees\Employee;
use App\Models\BaseModels\Organization;
use App\Models\Subsystem\Outgoing\OutUsersRole;
use App\Models\UserRoles;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;


class AuthController extends Controller
{

    private $errorMessages = [
        'login.required' => 'Обязательно нужен логин',
        'login.min' => 'Длина логина не менее 3 символов',
        'login.max' => 'Длина логина не более 25 символов',
        'login.string' => 'Логин должен быть строкой',
        'login.unique' => 'Такой логин уже зарегестрирован в системе',
        'password.required' => 'Необходимо указать пароль',
        'password.min' => 'Длина пароля должна быть не менее 6 символов',
        'password.max' => 'Длинна пароля превышает максимальную длину 35 символов',
        'password.confirm' => 'Пароли не совпадают',
        'employee_id.required' => 'Уникальный идентификатор сотрудника обязателен',
        'employee_id.integer' => 'Уникальный идентификатор сотрудника должен быть в числовом выражении',
    ];

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }


    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'login' => 'required|min:3|max:25|string|unique:users,login',
            'password' => 'required|confirmed|string|min:6|max:35',
            'employee_id' => 'required|integer',
        ], $this->errorMessages);
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors(),
            ], 400);
        }
        $employeeId = $request->employee_id;
        if (!$this->employeeExists($employeeId)) {
            return response()->json([
                'message' => 'Сотрудник с таким идентификатором не найден'
            ], 400);
        }
        if ($this->employeeBusy($employeeId)) {
            return response()->json([
                'message' => 'Такой сотрудник уже привязан к учетной записи'
            ], 400);
        }
        $user = new User();
        $user->login = $request->login;
        $user->password = Hash::make($request->password);
        $user->save();
        UserRoles::create(['user_id' => $user->id]);
        $employee = Employee::find($employeeId);
        $employee->user_id = $user->id;
        $employee->save();
        $token = Auth::login($user, true);
        return response()->json([
            'message' => 'Пользователь успешно создан',
            'user' => $user,
            'employee' => $user->employee,
            'token' => 'Bearer' . $token,
        ], 201);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'login' => 'required|min:3',
            'password' => 'required|min:6',
        ], $this->errorMessages);
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors(),
            ], 400);
        }
        $credentials = $request->only('login', 'password');
        $token = Auth::attempt($credentials);
        if (!$token) {
            return response()->json([
                'status' => 'Ошибка',
                'message' => 'Неудачная авторизация',
                'data' => $credentials
            ], 401);
        }
        $user = Auth::user();
        return response()->json([
            'status' => 'Успешная авторизация',
            'user' => $user,
            'employee' => $user->employee,
            'token' => 'Bearer '.$token
        ], 200);
    }

    public function refresh()
    {
        return response()->json([
            'token' => 'Bearer '.Auth::refresh(),
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

    private function employeeExists($employeeId)
    {
        $employee = Employee::where('id', $employeeId)->first();
        return $employee !== null;
    }

    private function employeeBusy($employeeId)
    {
        $employee = Employee::where('id', $employeeId)->first();
        return $employee->user_id !== null;
    }

}
