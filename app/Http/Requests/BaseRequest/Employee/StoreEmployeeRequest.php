<?php

namespace App\Http\Requests\BaseRequest\Employee;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|min:3|max:25',
            'last_name' => 'required|string|min:3|max:25',
            'patronymic' => 'string|min:3|max:15',
            'phone_number' => [
                'string', 'required'
            ],
            'email' => 'required|email|unique:employees,email',
            'rank' => 'integer|min:1|max:7',
            'sex' => 'boolean',
            'cabinet' => 'required|integer',
            'personal_data_access' => 'boolean',
            'appointment_id' => 'required|exists:appointments,id',
            'organization_id' => 'required|exists:organizations,id',
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'first_name.required' => 'Необходимо указать имя',
            'first_name.string' => 'Неверный формат данных',
            'first_name.min' => 'Минимальная длина символов не менее 3 символов',
            'first_name.max' => 'Максимальная длина имени не более 25 символов',
            'last_name.required' => 'Фамилию обязательно нужно указать',
            'last_name.string' => 'Неверный формат данных',
            'last_name.min' => 'Минимальная длина фамилии не менее 3 символов',
            'last_name.max' => 'Максимальная длина фамилии не более 25 символов',
            'patronymic.string' => 'Неверный формат данных',
            'patronymic.min' => 'Длина отчества не менее 3 символов',
            'patronymic.max' => 'Длина отчества не более 15 символов',
            'phone_number.string' => 'Неверный формат данных',
            'phone_number.required' => 'Необходимо указать номер',
            'email.required' => 'Почту необходимо указать',
            'email.email' => 'Неверный формат почты',
            'email.unique' => 'Такая почта уже существует в системе',
            'rank.integer' => 'Неверный формат данных',
            'rank.min' => 'Минимальный ранг 1',
            'rank.max' => 'Максимальный ранг 7',
            'sex.boolean' => 'Неверный формат данных',
            'cabinet.required' => 'Необходимо указать кабинет',
            'cabinet.integer' => 'Неверный формат данных',
            'personal_data_access.boolean' => 'Неверный формат данных',
            'appointment_id.required' => 'Необходимо указать должность',
            'appointment_id.exists' => 'Такой должности не существует',
            'organization_id.required' => 'Необходимо указать организацию',
            'organization_id.exists' => 'Такой организации не существует в системе',
        ];
    }
}
