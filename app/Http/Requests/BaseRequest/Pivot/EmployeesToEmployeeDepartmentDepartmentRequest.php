<?php

namespace App\Http\Requests\BaseRequest\Pivot;

use App\Rules\BaseRule\Employee\EmployeeToDepartmentRule;
use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class EmployeesToEmployeeDepartmentDepartmentRequest extends FormRequest
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
    #[ArrayShape(['employee_id' => "array", 'employee_department_id' => "string[]"])]
    public function rules(): array
    {
        return [
            'employee_id' => [
                'required',
                'exists:employees,id',
                'unique:employees_to_departments,employee_id',
                'unique:employees_to_employee_departments,employee_id',
                new EmployeeToDepartmentRule
            ],
            'employee_department_id' => [
                'required',
                'exists:employee_departments,id',
            ]
        ];
    }

    #[ArrayShape(['employee_id.required' => "string", 'employee_id.exists' => "string", 'employee_id.unique' => "string", 'employee_department_id.required' => "string", 'employee_department_id.exists' => "string"])]
    public function messages(): array
    {
        return [
            'employee_id.required' => 'Необходимо указать сотрудника',
            'employee_id.exists' => 'Такого сотрудника не существует',
            'employee_id.unique' => 'Такой сотрудник уже добавлен в другой отдел',
            'employee_department_id.required' => 'Необходимо указать отдел',
            'employee_department_id.exists' => 'Такого отдела не существует'
        ];
    }
}
