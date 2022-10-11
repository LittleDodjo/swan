<?php

namespace App\Http\Controllers\Api\User;

use App\Models\Subsystem\Outgoing\OutUsersRole;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;


class AuthController extends Controller
{

    use SubsystemConfig;


    private $errorMessages = [
        'first_name.required' => 'Необходимо указать имя',
        'first_name.min' => 'Минимальная длинна имени не менее :size символов',
        'first_name.max' => 'Максимальная длинна имени не болле :size символов',
        'first_name.alpha' => 'Имя должно состоять только из букв',
        'last_name.required' => 'Необходимо указать фамилию',
        'last_name.min' => 'Минимальная длинна фамилии не менее :size символов',
        'last_name.max' => 'Максимальная длинна фамилии не более :size символов',
        'last_name.alpha' => 'Имя должно состоять только из букв',
        'patronymic.required' => 'Необходимо указать отчество',
        'patronymic.min' => 'Минимальная длинна отчества не менее :size символов',
        'patronymic.max' => 'Максимальная длинна отчества не более :size символов',
        'patronymic.alpha' => 'Отчество должно состоять только из букв',
        'login.required' => 'Необходимо указать логин',
        'login.min' => 'Длинна логина не менее :size символов',
        'login.max' => 'Длинна логина не более :size символов',
        'login.unique' => 'Такой логин уже существует в системе',
        'email.required' => 'Необходимо указать почту',
        'email.email' => 'Некорректный формат почты',
        'email.unique' => 'Такая почта уже существует в системе',
        'password.required' => 'Необходимо указать пароль',
        'password.confirmed' => 'Пароли не совпадают',
        'password.min' => 'Длинна пароля должна быть не менее :size символов',
    ];

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }


    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|alpha|min:3|max:15',
            'last_name' => 'required|string|alpha|min:3|max:15',
            'patronymic' => 'required|string|min:3|max:15',
            'login' => 'required|string|min:3|max:15|unique:users,login',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|string|min:6',
        ], $this->errorMessages);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $user = User::create(array_merge(
            $validator->validated(),
            ['password' => Hash::make($request->password)]
        ));
        $s = $this->appendUserRoles($user);
        $token = Auth::login($user, true);
//        $token = ''; $user = '';
        return response()->json([
            'message' => 'Пользователь успешно создан',
            'user' => $user,
            'password' => Hash::make($request->password),
            'authorisation' => [
                'token' => $token,
                'type' => 'Bearer',
            ],
            's' => $s
        ], 201);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'login' => 'required|min:3',
            'password' => 'required|min:6',
        ], $this->errorMessages);

        if ($validator->fails()) {
            $data = [];
            foreach ($validator->errors()->toArray() as $v => $k) {
                $data[] = $k[0];
            }
            return response()->json($data, 401);
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
            'authorization' => [
                'token' => $token,
                'type' => 'Bearer'
            ]
        ], 200);
    }


    public function refresh()
    {
        return response()->json([
            'status' => 'Успешно',
            'user' => Auth::user(),
            'authorization' => [
                'token' => Auth::refresh(),
                'type' => 'Bearer',
            ]
        ]);
    }


    public function logout()
    {
        Auth::logout();
        return response()->json([
            'status' => 'Успешно',
            'message' => 'Вы успешно вышли из системы',
        ]);
    }


    private function appendUserRoles($user)
    {
        $role = $this->subsystemRoleConfig;
        foreach ($role as $k => $v) {
            $system = new $v(
                ['user_id' => $user->id]
            );
            $system->save();
        }
        return true;
    }

}
