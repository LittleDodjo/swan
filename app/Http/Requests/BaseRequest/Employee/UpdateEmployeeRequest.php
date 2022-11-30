<?php

namespace App\Http\Requests\BaseRequest\Employee;

use App\Rules\BaseRule\Employee\EmployeeRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
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
            'first_name' => 'string|min:3|max:25',
            'last_name' => 'string|min:3|max:25',
            'patronymic' => 'string|min:3|max:15',
            'phone_number' => [
                'string',
            ],
            'email' => 'email|unique:employees,email',
            'sex' => 'boolean',
            'cabinet' => 'integer',
            'personal_data_access' => 'boolean',
            'appointment_id' => 'exists:appointments,id',
            'organization_id' => 'exists:organizations,id',
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'first_name.string' => 'Неверный формат данных',
            'first_name.min' => 'Минимальная длина символов не менее 3 символов',
            'first_name.max' => 'Максимальная длина имени не более 25 символов',
            'last_name.string' => 'Неверный формат данных',
            'last_name.min' => 'Минимальная длина фамилии не менее 3 символов',
            'last_name.max' => 'Максимальная длина фамилии не более 25 символов',
            'patronymic.string' => 'Неверный формат данных',
            'patronymic.min' => 'Длина отчества не менее 3 символов',
            'patronymic.max' => 'Длина отчества не более 15 символов',
            'phone_number.string' => 'Неверный формат данных',
            'email.email' => 'Неверный формат почты',
            'email.unique' => 'Такая почта уже существует в системе',
            'sex.boolean' => 'Неверный формат данных',
            'cabinet.integer' => 'Неверный формат данных',
            'personal_data_access.boolean' => 'Неверный формат данных',
            'appointment_id.exists' => 'Такой должности не существует',
            'organization_id.exists' => 'Такой организации не существует в системе',
        ];
    }
}
