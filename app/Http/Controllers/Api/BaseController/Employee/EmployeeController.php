<?php

namespace App\Http\Controllers\Api\BaseController\Employee;

use App\Http\Controllers\Controller;
use App\Models\BaseModels\Employees\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{

    public function __construct()
    {
//        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    private $errorMessages = [
        'first_name.required' => 'Имя указать обязательно',
        'first_name.min' => 'Имя должно быть не менее 3 символов',
        'first_name.max' => 'Имя должно быть не более 25 символов',
        'first_name.string' => 'Ошибка указания Имени',
        'last_name.required' => 'Фамилия обязательное поле',
        'last_name.min' => 'Минимальная длинна фамилии 3',
        'last_name.max' => 'Максимальная длинна фамилии 25',
        'last_name.string' => 'Ошибка указания Фамилии',
        'patronymic.string' => 'Ошибка указания отчества',
        'patronymic.max' => 'Максимальная длиа Отчества не более 20 символов',
        'patronymic.min' => 'Минимальная длина Отчества не менее 3 символов',
        'phone_number.required' => 'Номер телефона укзаать обязательно',
        'phone_number.string' => 'Ошибка - неверный формат номера телефона',
        'appointment_id.required' => 'Должность нужно указать обязательно',
        'appointment_id.integer' => 'Ошибка указания должности',
        'depency_id.integer' => 'Ошибка указания зависимости',
        'email.required' => 'Необходимо указать почту',
        'email.email' => 'Неверный формат почты',
        'email.unique' => 'Такая почта уже существует в системе',
    ];

    public function newEmployee(Request $request){
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|min:3|max:25|string',
            'last_name' => 'required|min:3|max:25|string',
            'patronymic' => 'string|min:3|max:20',
            'phone_number' => 'required|string',
            'appointment_id' => 'required|integer',
            'depency_id' => 'integer',
            'organization_id' => 'required',
            'email' => 'required|email|unique:employees,email',
        ], $this->errorMessages);
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors(),
            ], 400);
        }
        $employee = Employee::create($validator->validated());
        return response()->json([
            'message' => 'Сотрудник успешно создан',
            'employee' => $employee,
        ], 201);
    }


}
