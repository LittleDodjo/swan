<?php

namespace App\Http\Requests\BaseRequest;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @property mixed $employee_id
 * @property mixed $login
 * @property mixed $password
 */
class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    #[ArrayShape(['login' => "string[]", 'password' => "string[]", 'employee_id' => "string[]"])]
    public function rules(): array
    {
        return [
            'login' => ['required', 'string', 'min:6', 'max:30', 'unique:users,login',],
            'password' => ['required', 'min:6', 'max:30', 'confirmed',],
            'employee_id' => ['required', 'exists:employees,id',],
        ];
    }

    public function messages(): array
    {
        return [
            'login.required' => 'Необходимо указать логин',
            'login.string' => 'Неверный формат данных',
            'login.min' => 'Длина логина должна быть не менее 6 символов',
            'login.max' => 'Длина логина должна быть не более 30 символов',
            'login.unique' => 'Такой логин уже существует в системе',
            'employee_id.required' => 'Необходимо указать идентификатор сотрудника',
            'employee_id.exists' => 'Такого сотрудника не найдено в системе',
            'password.required' => 'Необходимо указать пароль',
            'password.confirmation' => 'Необходимо подтверждение пароля',
            'password.min' => 'Длина пароля не менее 6 символов',
            'password.max' => 'Длина пароля не более 30 символов',
        ];
    }
}
