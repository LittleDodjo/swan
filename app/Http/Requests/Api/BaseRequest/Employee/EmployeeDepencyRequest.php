<?php

namespace App\Http\Requests\Api\BaseRequest\Employee;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeDepencyRequest extends FormRequest
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
            'employee_id' => 'required|integer',
            'employee_depends_id' => 'required|integer'
        ];
    }

    public function messages()
    {
        return [
            'employee_id.required' => 'Необходимо указать пользователя',
            'employee_id.integer' => 'Неверный идентификатор пользователя',
            'employee_depends_id.integer' => 'Необходимо указать пользователя',
            'employee_depends_id.required' => 'Неверный идентификатор пользователя',
        ];
    }
}
