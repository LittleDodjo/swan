<?php

namespace App\Http\Requests\Api\BaseRequest\User;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'login' => 'required|min:3|max:25|string|unique:users,login',
            'password' => 'required|confirmed|string|min:6|max:35',
            'employee_id' => 'required|integer'
        ];
    }

    public function messages()
    {
        return [
            'login.required' => 'Обязательно нужен логин',
            'login.min' => 'Длина логина не менее 3 символов',
            'login.max' => 'Длина логина не более 25 символов',
            'login.string' => 'Логин должен быть строкой',
            'login.unique' => 'Такой логин уже зарегестрирован в системе',
            'password.required' => 'Необходимо указать пароль',
            'password.min' => 'Длина пароля должна быть не менее 6 символов',
            'password.max' => 'Длинна пароля превышает максимальную длину 35 символов',
            'password.confirmed' => 'Пароли не совпадают',
            'employee_id.required' => 'Уникальный идентификатор сотрудника обязателен',
            'employee_id.integer' => 'Уникальный идентификатор сотрудника должен быть в числовом выражении',
        ];
    }
}
